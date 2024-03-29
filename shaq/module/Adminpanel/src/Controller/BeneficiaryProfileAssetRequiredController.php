<?php
namespace Aula_Adminpanel\Controller;

use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Db\Sql\Sql as Sql;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Adapter\AdapterInterface;

class BeneficiaryProfileAssetRequiredController extends AbstractActionController
{
	private $dbAdapter;
	private $sessionContainer;
	protected $request;
	private $config;
	private $redisCache;
	private $memCached;
	
	protected static $Aula_UID;
	protected static $Aula_OrgID;
	protected static $Aula_OwnerOrgID;
	protected static $Aula_OwnerOrgUserID;
	
	public function __construct(AdapterInterface $dbAdapter,$sessionContainer,$config,$redis,$memcached,$container)
    {
        $this->dbAdapter = $dbAdapter;
		$this->sessionContainer = $sessionContainer;
		$this->request = $this->getRequest();
		$this->config = $config;
		$this->redisCache = $redis;
		$this->memCached = $memcached;
				
		self::$Aula_UID = $this->sessionContainer->Aula_UID;
		self::$Aula_OrgID = $this->sessionContainer->Aula_OrgID;
		self::$Aula_OwnerOrgID = $this->sessionContainer->Aula_OwnerOrgID;
		self::$Aula_OwnerOrgUserID = $this->sessionContainer->Aula_OwnerOrgUserID;
		
		//$this->redisCache->flush();
    }
    public function indexAction()
    {		
		$activeLocalesArray = $this->AdminfunctionsPlugin()->getActiveLocales($this->dbAdapter);
		$globalLocalName = $this->AdminfunctionsPlugin()->getLocalNameById($this->dbAdapter,$this->config['global_locale_id']);
		
		return new ViewModel([
			'admin_layout_dir_path' => $this->config['site_dir_path']['admin_layout_dir_path'],
			'public_dir_path' => $this->config['site_dir_path']['public_dir_path'],
			'public_dir_url' => $this->config['site_dir_path']['public_dir_url'],
			'activeLocalesArray' => $activeLocalesArray,
			'global_locale_id' => $this->config['global_locale_id'],
			'globalLocalName' => $globalLocalName,
		]);
    }
	public function listAction()
    {
        echo $this->fnGrid();
        exit;
    }
	
	public function fnGrid()
	{
		$aColumns = array('`id`','`beneficiary`','`asset_name`','`asset_type`','`asset_unit_type`','`asset_quantity`','`asset_condition`','`status`');
		if(!($this->memCached->hasItem('aula_beneficiary_profile_asset_required_data')) || !is_array($this->memCached->getItem('aula_beneficiary_profile_asset_required_data')))
		{	
			$sTable = 'view_beneficiary_profile_asset_required';
		
			/* Indexed column (used for fast and accurate table cardinality) */
			$sIndexColumn = "id";  
			
			$sWhere = " WHERE 1=1 ";
			$sOrder = " ORDER BY $sIndexColumn DESC ";		
			
			/** SQL queries ** Get data to display **/ 
			$sQuery = "
				SELECT *
				FROM   $sTable
				$sWhere
				$sOrder
			";
			    
			$optionalParameters	= array();        
			$statement 			= $this->dbAdapter->createStatement($sQuery, $optionalParameters);        
			$resultData			= $statement->execute();        
			$resultSet 			= new ResultSet; 			   
			$resultSet->initialize($resultData);        
			$rowset 			= $resultSet->toArray();	
			
			$rowsetCache = array();
			foreach($rowset as $aRow)
			{
				$rowsetCache[$aRow['id']] = $aRow;
			}
			$this->memCached->setItem('aula_beneficiary_profile_asset_required_data',$rowsetCache);
		}
			
		$rowset = $this->memCached->getItem('aula_beneficiary_profile_asset_required_data');
		$iTotal = count($rowset);
		
		
		
		/** Output **/
		$output = array(
			"sEcho" => intval(@$_GET['sEcho']),
			"iTotalRecords" => $iTotal,
			"aaData" => array()
		);
	
		foreach($rowset as $aRow)
		{
			$row = array();
			for ( $i=0 ; $i < count($aColumns); $i++ ) 
			{
				$aColumns[$i] = str_replace('`','',$aColumns[$i]);
				switch($aColumns[$i]){
					case 'version' :
						$row[] = ($aRow[ $aColumns[$i] ]=="0") ? '-' : $aRow[ $aColumns[$i] ];
						break;
					case '' :
						// do nothing
						break;
					default :
						 $row[] = $aRow[ $aColumns[$i] ];
				}
			}
			$output['aaData'][] = $row; 
		}
		
		echo json_encode( $output ); 
	
	}
	
	
	public function exportcsvAction()
	{
		if ($this->request->isPost()) 
		{
			$csvData = '';
			$sql = "SELECT * FROM view_beneficiary_profile_asset_required WHERE 1 = 1";
			if($this->request->getPost("export_data") != "ALL")
				{
					$aData = json_decode($this->request->getPost("FORM_DATA"));
					$aData = (array)$aData;
					$allRecordsArray = $aData['gridHiddenIdArray[]'];
					if(!is_array($allRecordsArray))
					{				
						$allRecordsArray = array($allRecordsArray);	
					}
					$allSelectedIds = implode(",",$allRecordsArray);
					if($allSelectedIds == "")
						$allSelectedIds = 0;
						
					$sql .= " AND id IN (".$allSelectedIds.")";
				}		
			$optionalParameters	= array();        
			$statement 			= $this->dbAdapter->createStatement($sql, $optionalParameters);        
			$resultData			= $statement->execute();        
			$resultSet 			= new ResultSet; 			   
			$resultSet->initialize($resultData);        
			$rowset 			= $resultSet->toArray();	
			
			$csvData .= "#ID,Beneficiary,Asset,Asset Type,Asset Unit,Asset Quantity,Asset Condition,Status(Pending|Approved|Rejected|Out of Stock|Received),Beneficiary Profile Asset Received,Beneficiary Profile Asset Received Date(MM/DD/YYYY)";
			$csvData .= "\n";
			foreach($rowset as $row)
			{
				
				$csvData .= $row['id'].",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['beneficiary']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['asset_name']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['asset_type']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['asset_unit_type']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['asset_quantity']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['asset_condition']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['status']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['asset_received']).",";
				
				$date_ar1 = explode(" ",$row['beneficiary_profile_asset_received_date']);           	
			   	$date_ar = explode("-",$date_ar1[0]);
				$row['beneficiary_profile_asset_received_date'] = $date_ar[1].'/'.$date_ar[2].'/'.$date_ar[0];	
				$beneficiary_profile_asset_received_date = $row['beneficiary_profile_asset_received_date'];
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($beneficiary_profile_asset_received_date).",";	
				$csvData .= "\n";	
			}
			$this->AdminfunctionsPlugin()->exportCsvData($csvData,$this->request->getPost("exportfilename"),$this->config);
		}
		else
		{
			$result['DBStatus'] = 'ERR';
		}
        $result = json_encode($result);
        echo $result;
        exit;
	}
	
	public function importcsvAction()
    {			
        $projectTable = new TableGateway('beneficiary_profile_asset_required',$this->dbAdapter);
		if ($this->request->isPost()) {

            $file = $_FILES['importfile'];
            $filename = $_FILES['importfile']['name'];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
			if($ext == "csv")
			{            
				$filename = rand(0,999).$filename;
				
				$importFilePath =  $this->config['site_dir_path']['public_dir_path']."importcsv/".$filename;
		
				if (!move_uploaded_file($file['tmp_name'], $importFilePath)) {
					$result['status'] = 'ERR';
					$result['message1'] = 'Unable to save file![signature]';
				} 
				else 
				{	
					if (($handle = fopen($importFilePath, "r")) !== FALSE) 
					{
						fgetcsv($handle);   
					   	while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
							if($data[1] != "" && $data[2] != ""&& $data[3] != ""&& $data[4] != ""&& $data[5] != ""&& $data[6] != ""&& $data[7] != "")
							{
								
							 	
								$saveDataArray = array();
								$column_index = 1;
								
								
								
								$getBeneficiaryID = $this->AdminfunctionsPlugin()->validateduplicateLocaleCSV('beneficiary_locale',$this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]),'family_name','beneficiary_id',$this->dbAdapter,$this->config['global_locale_id'],'locale_id');
								$saveDataArray['beneficiary_id']			= $getBeneficiaryID;
								
								$getAssetID = $this->AdminfunctionsPlugin()->validateduplicateLocaleCSV('asset_locale',$this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]),'name','asset_id',$this->dbAdapter,$this->config['global_locale_id'],'locale_id');
								$saveDataArray['asset_id']			= $getAssetID;
								
								$getAssettypeID = $this->AdminfunctionsPlugin()->validateduplicateLocaleCSV('asset_type_locale',$this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]),'name','asset_type_id',$this->dbAdapter,$this->config['global_locale_id'],'locale_id');
								$saveDataArray['asset_type_id']			= $getAssettypeID;
																
								$getAssetunitID = $this->AdminfunctionsPlugin()->validateduplicateLocaleCSV('asset_unit_type_locale',$this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]),'name','asset_unit_type_id',$this->dbAdapter,$this->config['global_locale_id'],'locale_id');
								$saveDataArray['asset_unit_id']			= $getAssetunitID;
								
								$saveDataArray['asset_quantity'] 				= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								
								$getAssetconditionID = $this->AdminfunctionsPlugin()->validateduplicateLocaleCSV('asset_condition_locale',$this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]),'name','asset_condition_id',$this->dbAdapter,$this->config['global_locale_id'],'locale_id');
								$saveDataArray['asset_condition_id']			= $getAssetconditionID;	
												
								
								$saveDataArray['status'] 				= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								
								$getAssetReceivedID = $this->AdminfunctionsPlugin()->validateduplicateLocaleCSV('view_beneficiary_profile_asset_received',$this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]),'asset','id',$this->dbAdapter,'','');
								$saveDataArray['beneficiary_profile_asset_received_id']			= $getAssetReceivedID;
								
								
								$saveDataArray['beneficiary_profile_asset_received_date']	=	$this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								
								if($saveDataArray['beneficiary_profile_asset_received_date'] != '') {
									$beneficiary_profile_asset_received_date_ar = explode("/",$saveDataArray['beneficiary_profile_asset_received_date']);
									$beneficiary_profile_asset_received_date = $beneficiary_profile_asset_received_date_ar[2].'-'.$beneficiary_profile_asset_received_date_ar[0].'-'.$beneficiary_profile_asset_received_date_ar[1];
									$saveDataArray['beneficiary_profile_asset_received_date'] = $beneficiary_profile_asset_received_date;
								}
								
								$existRecordID = $data[0];
								
								
								if($existRecordID > 0)
								{
									$saveDataArray['date_updated'] = date('Y-m-d H:i:s');		
									$projectTable->update($saveDataArray,array("id=".$existRecordID));
								}
								else
								{
									
									
									$saveDataArray['owner_organization_id'] = self::$Aula_OwnerOrgID;
									$saveDataArray['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;								
									$projectTable->insert($saveDataArray);	
								}
							}
						}
						$result['status'] = 'OK';
						$result['message1'] = 'Csv imported successfully.';
						$this->memCached->setItem('aula_beneficiary_profile_asset_required_data','');
					}
					else
					{
						$result['status'] = 'ERR';
						$result['message1'] = 'Unable to open file!';
					}
				}
			}
			else 
			{
				$result['status'] = 'ERR';
				$result['message1'] = 'Allowed only csv files.';
			}	
        }
        $result = json_encode($result);
        echo $result;
        exit;
		
	}
	public function downloadtemplateAction()
	{
		$csvData = '';		
		$csvData .= "#ID,Beneficiary,Asset,Asset Type,Asset Unit,Asset Quantity,Asset Condition,Status(Pending|Approved|Rejected|Out of Stock|Received),Beneficiary Profile Asset Received,Beneficiary Profile Asset Received Date(MM/DD/YYYY)";
		$csvData .= "\n";
		header('Content-Type: text/csv; charset=utf-8');
		header("Content-Disposition: attachment; filename=beneficiary-profile-asset-required.csv");
		echo $csvData;
		exit;
	}
	public function validateduplicateAction()
    {
        if ($this->request->isPost()) {
            $tableName = $this->request->getPost('tableName');
            $ID = $this->request->getPost('KEY_ID');
			$EDIT_ID = $this->request->getPost('iActiveID');
            $fieldName = $this->request->getPost('fieldName'); 
			
			
			$this->AdminfunctionsPlugin()->validateduplicate($tableName,$ID,$fieldName,$EDIT_ID,$this->dbAdapter);          
        }
		else {
			$result1['DBStatus'] = 'ERR';
			$result1 = json_encode($result1);
			echo $result1;
		}
        exit;
    }
	public function getrecAction()
    {
        $recs=array();
        if ($this->request->isPost()) {
            
			$iID = $this->request->getPost("KEY_ID");
			
			if($this->memCached->hasItem('aula_beneficiary_profile_asset_required_data') && is_array($this->memCached->getItem('aula_beneficiary_profile_asset_required_data')))
			{
				$beneficiary_profile_asset_required = $this->memCached->getItem('aula_beneficiary_profile_asset_required_data');
				$rowset[0] = $beneficiary_profile_asset_required[$iID];
			}
			else
			{
				$projectTable = new TableGateway('view_beneficiary_profile_asset_required', $this->dbAdapter);
				$rowset = $projectTable->select(array('id' => $iID));
				$rowset = $rowset->toArray();
			}

            foreach ($rowset as $record)
			{
				$date_ar1 = explode(" ",$record['beneficiary_profile_asset_received_date']);           	
			   	$date_ar = explode("-",$date_ar1[0]);
				$record['beneficiary_profile_asset_received_date'] = $date_ar[1].'/'.$date_ar[2].'/'.$date_ar[0];		
			    $recs[] = $record;
				$beneficiary_profile_asset_received_id=$recs[0]['beneficiary_profile_asset_received_id'];
				unset($recs[0]['beneficiary_profile_asset_received_id']);
				$recs[0]['beneficiary_profile_asset_received_id']=$beneficiary_profile_asset_received_id;
				
			}	
            $result['data'] = $recs;
            $result['recordsTotal'] = count($recs);
            $result['DBStatus'] = 'OK';

            $result = json_encode($result);
            echo $result;
            exit;
        }
    }
	
	public function  deleteAction()
    {
        
        if ($this->request->isPost()) {

            $projectTable = new TableGateway('beneficiary_profile_asset_required', $this->dbAdapter);

            if ($this->request->getPost("pAction") == "DELETE") {
                $iMasterID = $this->request->getPost("KEY_ID");
				
					$projectTable->delete(array("id=".$iMasterID));
					$this->memCached->setItem('aula_beneficiary_profile_asset_required_data','');
					$result['DBStatus'] = 'OK';
				
                $result = json_encode($result);
				
                echo $result;
                exit;
            }
        }
    }
    public function saveAction()
    {        
		$tableName = 'beneficiary_profile_asset_required';
        if ($this->request->isPost()) {

            $projectTable = new TableGateway($tableName,$this->dbAdapter);
			
			$aData = json_decode($this->request->getPost("FORM_DATA"));
			$aData = (array)$aData;	
			if($aData['beneficiary_profile_asset_received_date'] != '') {
				$beneficiary_profile_asset_received_date_ar = explode("/",$aData['beneficiary_profile_asset_received_date']);
				$beneficiary_profile_asset_received_date = $beneficiary_profile_asset_received_date_ar[2].'-'.$beneficiary_profile_asset_received_date_ar[0].'-'.$beneficiary_profile_asset_received_date_ar[1];
				$aData['beneficiary_profile_asset_received_date'] = $beneficiary_profile_asset_received_date;
			}		
			if ($this->request->getPost("pAction") == "ADD")
			{	
				unset($aData['MASTER_KEY_ID']);
				$aData['owner_organization_id'] = self::$Aula_OwnerOrgID;
				$aData['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;
				
				$projectTable->insert($aData);											
				$result['DBStatus'] = 'OK';
			}
			else  if($this->request->getPost("pAction") == "EDIT")
			{
				$iMasterID=$aData['MASTER_KEY_ID'];
				unset($aData['MASTER_KEY_ID']);
				$aData['date_updated'] = date('Y-m-d H:i:s');
		
				$projectTable->update($aData,array("id=".$iMasterID));
				$result['DBStatus'] = 'OK';
			}
			$this->memCached->setItem('aula_beneficiary_profile_asset_required_data','');
        }
        else
        {
            $result['DBStatus'] = 'ERR';
        }

        $result = json_encode($result);
        echo $result;
        exit;
    }
	public function savemanageassetAction()
    {					
		$tableName = 'beneficiary_profile_asset_required';
        if ($this->request->isPost()) {

            $projectTable = new TableGateway($tableName,$this->dbAdapter);
			$aData = json_decode($this->request->getPost("FORM_DATA"));
			$aData = (array)$aData;
			if($aData['beneficiary_profile_asset_received_date'] != '') {
				$beneficiary_profile_asset_received_date_ar = explode("/",$aData['beneficiary_profile_asset_received_date']);
				$beneficiary_profile_asset_received_date = $beneficiary_profile_asset_received_date_ar[2].'-'.$beneficiary_profile_asset_received_date_ar[0].'-'.$beneficiary_profile_asset_received_date_ar[1];
				$aData['beneficiary_profile_asset_received_date'] = $beneficiary_profile_asset_received_date;
			}
			unset($aData['MASTER_KEY_ID']);
			$aData['owner_organization_id'] = self::$Aula_OwnerOrgID;
			$aData['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;
			$aData['beneficiary_profile_asset_received_date'] = $beneficiary_profile_asset_received_date;
			$projectTable->insert($aData);											
			$result['DBStatus'] = 'OK';
			$this->memCached->setItem('aula_beneficiary_profile_asset_required_data','');
			
        }
        else
        {
            $result['DBStatus'] = 'ERR';
        }

        $result = json_encode($result);
        echo $result;
        exit;
	}
	public function getgroupAction() 
	  {                
		$sql="select id as id,name as name from beneficiary_group";		        
		$optionalParameters=array();        
		$statement 		   = $this->dbAdapter->createStatement($sql, $optionalParameters);       
	    $result = $statement->execute();        
		$resultSet = new ResultSet;        
		$resultSet->initialize($result);        
		$rowset=$resultSet->toArray();        
		$result1['DBData'] = $rowset;        
		$result1['recordsTotal'] = count($rowset);        
		$result1['DBStatus'] = 'OK';        
		$result = json_encode($result1);       
		echo $result;        
		exit;    
	 }
}
