<?php
namespace Aula_Adminpanel\Controller;

use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Db\Sql\Sql as Sql;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Adapter\AdapterInterface;

class PaymentMethodConfigurationController extends AbstractActionController
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
		
		$aColumns = array( '`id`','`config_key`','`config_value`','`locale`','`environment`','`payment_method`','`country_name`');
		if(!($this->memCached->hasItem('aula_methodconfiguration_data')) || !is_array($this->memCached->getItem('aula_methodconfiguration_data')))
		{	
			$sTable = 'view_payment_method_configuration';
		
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
			$this->memCached->setItem('aula_methodconfiguration_data',$rowsetCache);
		}
			
		$rowset = $this->memCached->getItem('aula_methodconfiguration_data');
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
			$sql = "SELECT * FROM view_payment_method_configuration WHERE 1 = 1";	
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
			
			$csvData .= "#ID,Config Key,Config Value,Locale,Environment(DEV|STG|LIVE),Payment Method,Country";
			$csvData .= "\n";
			foreach($rowset as $row)
			{
				$csvData .= $row['id'].",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['config_key']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['config_value']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['locale']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['environment']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['payment_method']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['country_name']).",";
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
        $projectTable = new TableGateway('payment_method_configuration',$this->dbAdapter);
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
							if($data[1] != "" && $data[2] != "" && $data[3] != "" && $data[4] != "" && $data[5] != "" && $data[6] != "" )
							{
							 
								$saveDataArray = array();
								$column_index = 1;
								
								$saveDataArray['config_key'] 	= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$saveDataArray['config_value'] 	= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$getLocaleID = $this->AdminfunctionsPlugin()->validateduplicateLocaleCSV('locale',$this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]),'name','id',$this->dbAdapter,$this->config['global_locale_id']);
								$saveDataArray['locale_id'] 	= $getLocaleID;
								
								$saveDataArray['environment'] 	= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								
								$getPaymentMethodID = $this->AdminfunctionsPlugin()->validateduplicateLocaleCSV('payment_method_locale',$this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]),'name','payment_method_id',$this->dbAdapter,$this->config['global_locale_id'],'locale_id');
								$saveDataArray['payment_method_id']= $getPaymentMethodID;
								
								$getCountryID = $this->AdminfunctionsPlugin()->validateduplicateLocaleCSV('country_locale',$this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]),'name','country_id',$this->dbAdapter,$this->config['global_locale_id'],'locale_id');
								$saveDataArray['country_id'] 		= $getCountryID;
								
								$fnameValPair = array();
								$fnameValPair['config_key ']=$saveDataArray['config_key'];
								$fnameValPair['country_id ']=$saveDataArray['country_id'];
								
								$existRecordID = $this->AdminfunctionsPlugin()->validateduplicatemultipleCSV('view_payment_method_configuration',$data[0],$fnameValPair,$this->dbAdapter);	
								if($existRecordID > 0)
								{
									continue;
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
						$this->memCached->setItem('aula_methodconfiguration_data','');
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
		$csvData .= "#ID,Config Key,Config Value,Locale,Environment(DEV|STG|LIVE),Payment Method,Country";
		$csvData .= "\n";
		header('Content-Type: text/csv; charset=utf-8');
		header("Content-Disposition: attachment; filename=payment-method-configurations.csv");
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
        }		else {
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
			
			if($this->memCached->hasItem('aula_methodconfiguration_data') && is_array($this->memCached->getItem('aula_methodconfiguration_data')))
			{
				$payment_method_configurations = $this->memCached->getItem('aula_methodconfiguration_data');
				$rowset[0] = $payment_method_configurations[$iID];
			}
			else
			{
				$projectTable = new TableGateway('payment_method_configuration', $this->dbAdapter);
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

            $projectTable = new TableGateway('payment_method_configuration', $this->dbAdapter);

            if ($this->request->getPost("pAction") == "DELETE") {
                $iMasterID = $this->request->getPost("KEY_ID");
				
				$projectTable->delete(array("id=".$iMasterID));
				$this->memCached->setItem('aula_methodconfiguration_data','');
                $result['DBStatus'] = 'OK';
                $result = json_encode($result);
                echo $result;
                exit;
            }
        }
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
		$tableName = 'payment_method_configuration';
        if ($this->request->isPost()) {

            $projectTable = new TableGateway($tableName,$this->dbAdapter);
			
			$aData = json_decode($this->request->getPost("FORM_DATA"));
			$aData = (array)$aData;			
			

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
			$this->memCached->setItem('aula_methodconfiguration_data','');
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
