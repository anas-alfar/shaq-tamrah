<?php
namespace Aula_Adminpanel\Controller;

use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Db\Sql\Sql as Sql;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Adapter\AdapterInterface;

class MessageController extends AbstractActionController
{
	private $dbAdapter;
	private $sessionContainer;
	protected $request;
	private $config;
	private $redisCached;
	private $memCached;
	private $global_locale_id;
	
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
		$this->memCached = $redis;
		$this->memCached = $memcached;
		$this->global_locale_id = $config['global_locale_id'];
				
		self::$Aula_UID = $this->sessionContainer->Aula_UID;
		self::$Aula_OrgID = $this->sessionContainer->Aula_OrgID;
		self::$Aula_OwnerOrgID = $this->sessionContainer->Aula_OwnerOrgID;
		self::$Aula_OwnerOrgUserID = $this->sessionContainer->Aula_OwnerOrgUserID;
		
		//$this->memCached->flush();
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
		
		$aColumns = array( '`id`','`message_type`','`from_name`','`from_email`','`to_name`','`to_email`','`subject`','`locale`','`beneficiary`');
		if(!($this->memCached->hasItem('aula_beneficiary_message_email_data')) || !is_array($this->memCached->getItem('aula_beneficiary_message_email_data')))
		{	
			$sTable = 'view_beneficiary_message_email';
		
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
			$this->memCached->setItem('aula_beneficiary_message_email_data',$rowsetCache);
		}
			
		$rowset = $this->memCached->getItem('aula_beneficiary_message_email_data');
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
			$sql = "SELECT * FROM view_beneficiary_message_email WHERE 1 = 1";	
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
				
				$csvData .= "#ID,Message Type,From Name,From Email,To Name,To Email,Subject,Locale,Message Template,Beneficiary,Content";
				$csvData .= "\n";
				foreach($rowset as $row)
				{
					$csvData .= $row['id'].",";
					$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['message_type']).",";
					$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['from_name']).",";
					$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['from_email']).",";
					$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['to_name']).",";
					$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['to_email']).",";
					$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['subject']).",";
					$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['locale']).",";
					$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['message_template']).",";
					$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['beneficiary']).",";
					$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['content']).",";
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
        $projectTable = new TableGateway('beneficiary_message_email',$this->dbAdapter);
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
							if($data[1] != "" && $data[2] != "" && $data[3] != ""&& $data[4] != ""&& $data[5] != ""&& $data[6] != ""&& $data[7] != ""&& $data[8] != ""&& $data[9] != ""&& $data[10] != "" )
							{
							 
								$saveDataArray = array();
								$column_index = 1;
								
								$getMessageType = $this->AdminfunctionsPlugin()->validateduplicateLocaleCSV('view_message_type',$this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]),'name','id',$this->dbAdapter,$this->config['global_locale_id']);
								$saveDataArray['message_type_id'] 	= $getMessageType;
								
								$saveDataArray['from_name'] 		= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$saveDataArray['from_email'] 		= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$saveDataArray['to_name'] 		= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$saveDataArray['to_email'] 		= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$saveDataArray['subject'] 		= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								
								$getLocaleID = $this->AdminfunctionsPlugin()->validateduplicateLocaleCSV('locale',$this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]),'name','id',$this->dbAdapter,$this->config['global_locale_id']);
								$saveDataArray['locale_id'] 	= $getLocaleID;
								
								$getMessageTemplate = $this->AdminfunctionsPlugin()->validateduplicateLocaleCSV('view_message_template',$this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]),'from_name','id',$this->dbAdapter,$this->config['global_locale_id']);
								$saveDataArray['message_template_id'] 	= $getMessageTemplate;
								
								$getBeneficiary = $this->AdminfunctionsPlugin()->validateduplicateLocaleCSV('view_beneficiary',$this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]),'family_name','id',$this->dbAdapter,$this->config['global_locale_id']);
								$saveDataArray['beneficiary_id'] 	= $getBeneficiary;
								$saveDataArray['content'] 		= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								
								$existRecordID = $this->AdminfunctionsPlugin()->validateduplicateCSV('beneficiary_message_email',$saveDataArray['from_name'],'from_name',$this->dbAdapter,$data[0]); 
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
									$saveDataArray['organization_id'] = self::$Aula_OrgID;
									$saveDataArray['owner_organization_id'] = self::$Aula_OwnerOrgID;
									$saveDataArray['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;								
									$projectTable->insert($saveDataArray);	
								}
							}
						}
						$result['status'] = 'OK';
						$result['message1'] = 'Csv imported successfully.';
						$this->memCached->setItem('aula_beneficiary_message_email_data','');
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
		$activeLocalesArray = $this->AdminfunctionsPlugin()->getActiveLocales($this->dbAdapter);
		$csvData = '';		
		
		$csvData .= "#ID,Message Type,From Name,From Email,To Name,To Email,Subject,Locale,Message Template,Beneficiary,Content";
		$csvData .= "\n";
		header('Content-Type: text/csv; charset=utf-8');
		header("Content-Disposition: attachment; filename=beneficiary_message_email.csv");
		echo $csvData;
		exit;
	}
    public function saveAction()
    {        
		$tableName = 'beneficiary_message_email';
        if ($this->request->isPost()) {

            $projectTable = new TableGateway($tableName,$this->dbAdapter);
			
			$aData = json_decode($this->request->getPost("FORM_DATA"));
			$aData = (array)$aData;			
			

			if ($this->request->getPost("pAction") == "ADD")
			{	
				unset($aData['MASTER_KEY_ID']);	
				
				
				$aData['content']=$aData['email_content'];	
				unset($aData['email_content']);
				$aData['organization_id'] = self::$Aula_OrgID;
				$aData['owner_organization_id'] = self::$Aula_OwnerOrgID;
				$aData['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;
				
				$projectTable->insert($aData);											
				$result['DBStatus'] = 'OK';
			}
			else  if($this->request->getPost("pAction") == "EDIT")
			{
				$iMasterID=$aData['MASTER_KEY_ID'];
				$aData['content']=$aData['email_content'];
				unset($aData['email_content']);
				unset($aData['MASTER_KEY_ID']);
				$aData['date_updated'] = date('Y-m-d H:i:s');
		
				$projectTable->update($aData,array("id=".$iMasterID));
				$result['DBStatus'] = 'OK';
			}
			$this->memCached->setItem('aula_beneficiary_message_email_data','');
        }
        else
        {
            $result['DBStatus'] = 'ERR';
        }

        $result = json_encode($result);
        echo $result;
        exit;
    }
	public function getrecAction()
    {
        $recs=array();
        if ($this->request->isPost()) {
            
			$iID = $this->request->getPost("KEY_ID");
			
			if($this->memCached->hasItem('aula_beneficiary_message_email_data') && is_array($this->memCached->getItem('aula_beneficiary_message_email_data')))
			{
				$translation = $this->memCached->getItem('aula_beneficiary_message_email_data');
				$rowset[0] = $translation[$iID];
			}
			else
			{
				$projectTable = new TableGateway('beneficiary_message_email', $this->dbAdapter);
				$rowset = $projectTable->select(array('id' => $iID));
				$rowset = $rowset->toArray();
			}

            foreach ($rowset as $record)
                $recs[] = $record;
				
			$email_content=	$recs[0]['content'];
			unset($recs[0]['content']);
			$recs[0]['email_content']= $email_content;
            $result['data'] = $recs;
            $result['recordsTotal'] = count($recs);
            $result['DBStatus'] = 'OK';

            $result = json_encode($result);
            echo $result;
            exit;
        }
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
	 
	
	
	public function listsmsAction()
    {
        echo $this->fnSmsGrid();
        exit;
    }
	public function fnSmsGrid()
	{
		
		$aColumns = array( '`id`','`message_type`','`from_name`','`from_mobile_number`','`to_name`','`to_mobile_number`','`subject`','`locale`','`beneficiary`');
		if(!($this->memCached->hasItem('aula_beneficiary_message_sms_data')) || !is_array($this->memCached->getItem('aula_beneficiary_message_sms_data')))
		{	
			$sTable = 'view_beneficiary_message_sms';
		
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
			$this->memCached->setItem('aula_beneficiary_message_sms_data',$rowsetCache);
		}
			
		$rowset = $this->memCached->getItem('aula_beneficiary_message_sms_data');
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
    public function savesmsAction()
    {        
		$tableName = 'beneficiary_message_sms';
        if ($this->request->isPost()) {

            $projectTable = new TableGateway($tableName,$this->dbAdapter);
			
			$aData = json_decode($this->request->getPost("FORM_DATA"));
			$aData = (array)$aData;			
			

			if ($this->request->getPost("pAction") == "ADD")
			{	
				unset($aData['MASTER_KEY_ID']);			
				$aData['organization_id'] = self::$Aula_OrgID;
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
			$this->memCached->setItem('aula_beneficiary_message_sms_data','');
        }
        else
        {
            $result['DBStatus'] = 'ERR';
        }

        $result = json_encode($result);
        echo $result;
        exit;
    }
	public function getrecsmsAction()
    {
        $recs=array();
        if ($this->request->isPost()) {
            
			$iID = $this->request->getPost("KEY_ID");
			
			if($this->memCached->hasItem('aula_beneficiary_message_sms_data') && is_array($this->memCached->getItem('aula_beneficiary_message_sms_data')))
			{
				$translation = $this->memCached->getItem('aula_beneficiary_message_sms_data');
				$rowset[0] = $translation[$iID];
			}
			else
			{
				$projectTable = new TableGateway('beneficiary_message_sms', $this->dbAdapter);
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
	public function smsexportcsvAction()
	{
		if ($this->request->isPost()) 
		{
			$csvData = '';
			$sql = "SELECT * FROM view_beneficiary_message_sms WHERE 1 = 1";	
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
				
				$csvData .= "#ID,Message Type,From Name,From Mobile Number,To Name,To Mobile Number,Subject,Locale,Message Template,Beneficiary,Content";
				$csvData .= "\n";
				foreach($rowset as $row)
				{
					$csvData .= $row['id'].",";
					$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['message_type']).",";
					$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['from_name']).",";
					$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['from_mobile_number']).",";
					$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['to_name']).",";
					$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['to_mobile_number']).",";
					$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['subject']).",";
					$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['locale']).",";
					$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['message_template']).",";
					$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['beneficiary']).",";
					$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['content']).",";
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
	public function downloadtemplatesmsAction()
	{
		$activeLocalesArray = $this->AdminfunctionsPlugin()->getActiveLocales($this->dbAdapter);
		$csvData = '';		
		
		$csvData .= "#ID,Message Type,From Name,From Mobile Number,To Name,To Mobile Number,Subject,Locale,Message Template,Beneficiary,Content";
		$csvData .= "\n";
		header('Content-Type: text/csv; charset=utf-8');
		header("Content-Disposition: attachment; filename=beneficiary_message_sms.csv");
		echo $csvData;
		exit;
	}
	public function smsimportcsvAction()
    {			
        $projectTable = new TableGateway('beneficiary_message_sms',$this->dbAdapter);
		if ($this->request->isPost()) {

            $file = $_FILES['importfilesms'];
            $filename = $_FILES['importfilesms']['name'];
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
							if($data[1] != "" && $data[2] != "" && $data[3] != ""&& $data[4] != ""&& $data[5] != ""&& $data[6] != ""&& $data[7] != ""&& $data[8] != ""&& $data[9] != ""&& $data[10] != "" )
							{
							 
								$saveDataArray = array();
								$column_index = 1;
								
								$getMessageType = $this->AdminfunctionsPlugin()->validateduplicateLocaleCSV('view_message_type',$this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]),'name','id',$this->dbAdapter,$this->config['global_locale_id']);
								$saveDataArray['message_type_id'] 	= $getMessageType;
								
								$saveDataArray['from_name'] 		= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$saveDataArray['from_mobile_number'] 		= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$saveDataArray['to_name'] 		= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$saveDataArray['to_mobile_number'] 		= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$saveDataArray['subject'] 		= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								
								$getLocaleID = $this->AdminfunctionsPlugin()->validateduplicateLocaleCSV('locale',$this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]),'name','id',$this->dbAdapter,$this->config['global_locale_id']);
								$saveDataArray['locale_id'] 	= $getLocaleID;
								
								$getMessageTemplate = $this->AdminfunctionsPlugin()->validateduplicateLocaleCSV('view_message_template',$this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]),'from_name','id',$this->dbAdapter,$this->config['global_locale_id']);
								$saveDataArray['message_template_id'] 	= $getMessageTemplate;
								
								$getBeneficiary = $this->AdminfunctionsPlugin()->validateduplicateLocaleCSV('view_beneficiary',$this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]),'family_name','id',$this->dbAdapter,$this->config['global_locale_id']);
								$saveDataArray['beneficiary_id'] 	= $getBeneficiary;
								$saveDataArray['content'] 		= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								
								$existRecordID = $this->AdminfunctionsPlugin()->validateduplicateCSV('beneficiary_message_email',$saveDataArray['from_name'],'from_name',$this->dbAdapter,$data[0]); 
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
									$saveDataArray['organization_id'] = self::$Aula_OrgID;
									$saveDataArray['owner_organization_id'] = self::$Aula_OwnerOrgID;
									$saveDataArray['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;								
									$projectTable->insert($saveDataArray);	
								}
							}
						}
						$result['status'] = 'OK';
						$result['message1'] = 'Csv imported successfully.';
						$this->memCached->setItem('aula_beneficiary_message_sms_data','');
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


 

}
