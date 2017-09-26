<?php
namespace Aula_Adminpanel\Controller;

use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Db\Sql\Sql as Sql;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Adapter\AdapterInterface;

class OrganizationAssetController extends AbstractActionController
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
		
		//$this->memCached->flush();
    }
    public function indexAction()
    {	
		/*if ($this->memCached->hasItem ( 'custom_key' )) {
			echo $this->memCached->getItem('custom_key'); 
			echo "in if"; die();
		}else{
			$this->memCached->setItem('custom_key', 'Custom Value');
			echo $this->memCached->getItem('custom_key');
			echo "in else"; die();
		}*/
		
		/*if ($this->memCached->hasItem ( 'custom_key1' )) {
			echo $this->memCached->getItem('custom_key1'); 
			echo "in if"; die();
		}else{
			$this->memCached->setItem('custom_key1', 'Custom Value');
			echo $this->memCached->getItem('custom_key1');
			echo "in else"; die();
		}*/		
		
		return new ViewModel([
			'admin_layout_dir_path' => $this->config['site_dir_path']['admin_layout_dir_path'],
			'public_dir_path' => $this->config['site_dir_path']['public_dir_path'],
			'public_dir_url' => $this->config['site_dir_path']['public_dir_url'],
		]);
    }
	public function listAction()
    {
        echo $this->fnGrid();
        exit;
    }
	
	public function fnGrid()
	{
		
		$aColumns = array( '`id`','`asset_name`','`asset_type`','`asset_unit_type`','`cost`','`tax_value`','`tax_type`','`currency_name`','`exchange_rate`','`organization_branch_name`','`status`');
		if(!($this->memCached->hasItem('aula_organization_asset_data')) || !is_array($this->memCached->getItem('aula_organization_asset_data')))
		{	
			$sTable = 'view_organization_asset';
		
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
			$this->memCached->setItem('aula_organization_asset_data',$rowsetCache);
		}
			
		$rowset = $this->memCached->getItem('aula_organization_asset_data');
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
			$sql = "SELECT * FROM view_organization_asset WHERE 1 = 1";	
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
			
			$csvData .= "#ID,Asset Name,Asset Type,Asset Unit,Cost,Tax Type,Tax Value,Currency Name,Exchange Rate,Organization Branch Name,Status(Active|Inactive)";
			$csvData .= "\n";
			foreach($rowset as $row)
			{
				$csvData .= $row['id'].",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['asset_name']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['asset_type']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['asset_unit_type']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['cost']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['tax_value']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['tax_type']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['currency_name']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['exchange_rate']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['organization_branch_name']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['status']).",";
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
        $projectTable = new TableGateway('organization_asset',$this->dbAdapter);
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
							if($data[1] != "" && $data[2] != "" && $data[3] != "" && $data[4] != "" && $data[5] != "" && $data[6] != "" && $data[7] != "" && $data[8] != "" && $data[9] != "" && $data[10] != "" )
							{
							 
								$saveDataArray = array();
								$column_index = 1;
							 	$getAssetID = $this->AdminfunctionsPlugin()->validateduplicateLocaleCSV('asset_locale',$this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]),'name','asset_id',$this->dbAdapter,$this->config['global_locale_id'],'locale_id');
								$saveDataArray['asset_id']= $getAssetID;
								
								$getAssettypeID = $this->AdminfunctionsPlugin()->validateduplicateLocaleCSV('asset_type_locale',$this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]),'name','asset_type_id',$this->dbAdapter,$this->config['global_locale_id'],'locale_id');
								$saveDataArray['asset_type_id']= $getAssettypeID;
								
								$getAssetunitID = $this->AdminfunctionsPlugin()->validateduplicateLocaleCSV('asset_unit_type_locale',$this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]),'name','asset_unit_type_id',$this->dbAdapter,$this->config['global_locale_id'],'locale_id');
								$saveDataArray['asset_unit_id'] 	= $getAssetunitID;
								
								$saveDataArray['cost'] 	= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$saveDataArray['tax_value'] 	= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$saveDataArray['tax_type'] 	= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$getCurrencyID = $this->AdminfunctionsPlugin()->validateduplicateCSV('currency',$this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]),'currency',$this->dbAdapter);
								$saveDataArray['currency'] 	= $getCurrencyID;
								
								$getexchangerateID = $this->AdminfunctionsPlugin()->validateduplicateCSV('currency_exchange_rate',$this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]),'exchange_rate',$this->dbAdapter);
								$saveDataArray['currency_exchange_rate_id'] 	= $getexchangerateID;
								
								
								
								$getBranchID = $this->AdminfunctionsPlugin()->validateduplicateLocaleCSV('organization_branch_locale',$this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]),'name','organization_branch_id',$this->dbAdapter,$this->config['global_locale_id'],'locale_id');
								$saveDataArray['organization_branch_id']= $getBranchID;
								
								$saveDataArray['status'] 	= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$status = $saveDataArray['status'];
								if($status == "Active")
								{
									$fnameValPair = array();
									$fnameValPair['asset_id']=$saveDataArray['asset_id'];
									$fnameValPair['status']=$saveDataArray['status'];
									
									$existRecordID = $this->AdminfunctionsPlugin()->validateduplicatemultipleCSV('view_organization_asset',$data[0],$fnameValPair,$this->dbAdapter);	
									if($existRecordID > 0)
									{
										continue;
									}
								}
															
								$existRecordID = $data[0]; 
								if($existRecordID > 0)
								{
									$saveDataArray['date_updated'] = date('Y-m-d H:i:s');		
									$projectTable->update($saveDataArray,array("id=".$existRecordID));
								}
								else
								{
									
									$saveDataArray['organization_id'] 	= self::$Aula_OrgID;
									$saveDataArray['organization_branch_id']= $getBranchID;
									$saveDataArray['owner_organization_id'] = self::$Aula_OwnerOrgID;
									$saveDataArray['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;								
									$projectTable->insert($saveDataArray);	
								}
							}
						}
						$result['status'] = 'OK';
						$result['message1'] = 'Csv imported successfully.';
						$this->memCached->setItem('aula_organization_asset_data','');
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
		$csvData .= "#ID,Asset Name,Asset Type,Asset Unit,Cost,Tax Type,Tax Value,Currency Name,Exchange Rate,Organization Branch Name,Status(Active|Inactive)";
		$csvData .= "\n";
		header('Content-Type: text/csv; charset=utf-8');
		header("Content-Disposition: attachment; filename=organization_asset.csv");
		echo $csvData;
		exit;
	}
	public function validateduplicateAction()
    {
        if ($this->request->isPost()) {
            $tableName = $this->request->getPost('tableName');
			$EDIT_ID = $this->request->getPost('iActiveID');
			$fnameValPair = $this->request->getPost('fnameValPair');			
			
			$this->AdminfunctionsPlugin()->validateduplicatemultiple($tableName,$EDIT_ID,$fnameValPair,$this->dbAdapter);           
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
			
			if($this->memCached->hasItem('aula_organization_asset_data') && is_array($this->memCached->getItem('aula_organization_asset_data')))
			{
				$organization_asset = $this->memCached->getItem('aula_organization_asset_data');
				$rowset[0] = $organization_asset[$iID];
			}
			else
			{
				$projectTable = new TableGateway('organization_asset', $this->dbAdapter);
				$rowset = $projectTable->select(array('id' => $iID));
				$rowset = $rowset->toArray();
			}

            foreach ($rowset as $record)
                $recs[] = $record;

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

            $projectTable = new TableGateway('organization_asset', $this->dbAdapter);

            if ($this->request->getPost("pAction") == "DELETE") {
                $iMasterID = $this->request->getPost("KEY_ID");
				
				$projectTable->delete(array("id=".$iMasterID));
				$this->memCached->setItem('aula_organization_asset_data','');
                $result['DBStatus'] = 'OK';
                $result = json_encode($result);
                echo $result;
                exit;
            }
        }
    }
		 public function bulksaveAction()
    {        
		$tableName = 'organization_asset';
        if ($this->request->isPost()) {

            $projectTable = new TableGateway($tableName,$this->dbAdapter);
			
			$aData = json_decode($this->request->getPost("FORM_DATA"));
			$aData = (array)$aData;
			$allRecordsArray = $aData['gridHiddenIdArray[]'];
			if(!is_array($allRecordsArray))
			{				
				$allRecordsArray = array($allRecordsArray);	
			}
			foreach($allRecordsArray as $iMasterID)
			{
				$updateData = array();
				$updateData['status'] = $this->setCheckboxValue($aData,'status'.$iMasterID,'Active','Inactive');
				$projectTable->update($updateData,array("id=".$iMasterID));				
			}
			$this->memCached->setItem('aula_organization_asset_data','');
			$result['DBStatus'] = 'OK';
		}
		else
        {
            $result['DBStatus'] = 'ERR';
        }

        $result = json_encode($result);
        echo $result;
        exit;
	}

	
	public function setCheckboxValue($dataArray,$dataField,$onValue,$offValue)
	{
		if(isset($dataArray[$dataField]) && $dataArray[$dataField]=="on")
			return $onValue;
		else
			return $offValue;
	}
    public function saveAction()
    {        
		$tableName = 'organization_asset';
        if ($this->request->isPost()) {

            $projectTable = new TableGateway($tableName,$this->dbAdapter);
			
			$aData = json_decode($this->request->getPost("FORM_DATA"));
			$aData = (array)$aData;			
			
			$aData['status'] = $this->setCheckboxValue($aData,'status','Active','Inactive');
			if ($this->request->getPost("pAction") == "ADD")
			{	
				unset($aData['MASTER_KEY_ID']);			
				$aData['organization_id']									 = self::$Aula_OrgID;
				$aData['owner_organization_id']									 = self::$Aula_OwnerOrgID;
				$aData['owner_organization_user_id']							 = self::$Aula_OwnerOrgUserID;
				
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
			$this->memCached->setItem('aula_organization_asset_data','');
        }
        else
        {
            $result['DBStatus'] = 'ERR';
        }

        $result = json_encode($result);
        echo $result;
        exit;
    }
}
