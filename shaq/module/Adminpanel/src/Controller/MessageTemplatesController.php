<?php
namespace Aula_Adminpanel\Controller;

use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Db\Sql\Sql as Sql;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Adapter\AdapterInterface;

class MessageTemplatesController extends AbstractActionController
{
	private $dbAdapter;
	private $sessionContainer;
	protected $request;
	private $config;
	private $redisCache;
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
		$this->redisCache = $redis;
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
		$activeLocalesArray = $this->AdminfunctionsPlugin()->getActiveLocales($this->dbAdapter);
		$aColumns = array( '`id`','`from_name`','`to_name`','`subject`','`to_email`','`to_mobile_number`','`from_email`','`from_mobile_number`','`message_type`','`message_type_name`','`published`');
		if(!($this->memCached->hasItem('aula_templates_data')) || !is_array($this->memCached->getItem('aula_templates_data')))
		{	
			$sTable = 'view_message_template';
		
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
				foreach($activeLocalesArray as $locale)
				{
					$sQuery_locale 		= "SELECT from_name,to_name,subject,description FROM message_template_locale WHERE locale_id = '".$locale['id']."' AND message_template_id = '".$aRow['id']."' ";
					$statement_locale	= $this->dbAdapter->createStatement($sQuery_locale, $optionalParameters);        
					$resultData_locale	= $statement_locale->execute();        
					$resultSet_locale	= new ResultSet; 			   
					$resultSet_locale->initialize($resultData_locale);        
					$rowset_locale		= $resultSet_locale->toArray();
					$aRow['from_name_'.$locale['id']] = $rowset_locale[0]['from_name'];
					$aRow['to_name_'.$locale['id']] = $rowset_locale[0]['to_name'];
					$aRow['subject_'.$locale['id']] = $rowset_locale[0]['subject'];
					$aRow['description_'.$locale['id']] = $rowset_locale[0]['description'];
				}
				$rowsetCache[$aRow['id']] = $aRow;
			}
			$this->memCached->setItem('aula_templates_data',$rowsetCache);
		}
			
		$rowset = $this->memCached->getItem('aula_templates_data');
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
			$activeLocalesArray = $this->AdminfunctionsPlugin()->getActiveLocales($this->dbAdapter);		
			
			$csvData = '';		
			$sql = "SELECT * FROM view_message_template WHERE 1 = 1";
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
			$csvData .= "#ID,Message Type,Message For(Organization|Donor|Beneficiary),From Mobile Number,From Email,To Mobile Number,To Email,Published(Yes|No),";
			foreach($activeLocalesArray as $locale)
			{
				$csvData .= "From Name(".$locale['name']."),";
				$csvData .= "To Name(".$locale['name']."),";
				$csvData .= "Description(".$locale['name']."),";
				$csvData .= "Subject(".$locale['name']."),";
				
			}
			$csvData .= "\n";
				
			
			foreach($rowset as $row)
			{
				
				$csvData .= $row['id'].",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['message_type_name']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['message_type']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['from_mobile_number']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['from_email']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['to_mobile_number']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['to_email']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['published']).",";
				foreach($activeLocalesArray as $locale)
					{
						$sQuery_locale1 		= "SELECT from_name,to_name,subject,description FROM message_template_locale WHERE locale_id = '".$locale['id']."' AND message_template_id = '".$row['id']."' ";
						$statement_locale	= $this->dbAdapter->createStatement($sQuery_locale1, $optionalParameters);        
						$resultData_locale	= $statement_locale->execute();        
						$resultSet_locale	= new ResultSet; 			   
						$resultSet_locale->initialize($resultData_locale);        
						$rowset_locale		= $resultSet_locale->toArray();
						$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($rowset_locale[0]['from_name']).",";
						$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($rowset_locale[0]['to_name']).",";
						$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($rowset_locale[0]['subject']).",";
						$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($rowset_locale[0]['description']).",";
					}
				
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
		$activeLocalesArray = $this->AdminfunctionsPlugin()->getActiveLocales($this->dbAdapter);
        $projectTable = new TableGateway('message_template',$this->dbAdapter);
		$projectTableLocale = new TableGateway('message_template_locale',$this->dbAdapter);
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
							if($data[1] != "" && $data[2] != "" && $data[3] != "" && $data[4] != "" && $data[5] != "" &&$data[6] != ""&& $data[7] != ""&& $data[8] != ""&& $data[9] != "" &&$data[10] != "" )
							{
								$saveDataArray = array();
								$column_index = 1;
							 	$getMessageID = $this->AdminfunctionsPlugin()->validateduplicateLocaleCSV('message_type_locale',$this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]),'name','message_type_id',$this->dbAdapter,$this->config['global_locale_id'],'locale_id');
								
								
								$saveDataArray['message_type_id']= $getMessageID;
								$saveDataArray['message_type'] 	= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$saveDataArray['from_mobile_number'] 	= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$saveDataArray['from_email'] 	= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$saveDataArray['to_mobile_number'] 	= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$saveDataArray['to_email'] 	= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$saveDataArray['published'] 	= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								
								
								$detailData = array();
								$detailData['from_name'] 	= $data[$column_index++];
								$detailData['description'] 	= $data[$column_index++];
								$detailData['to_name'] 		= $data[$column_index++];
								$detailData['subject'] 		= $data[$column_index++];
								
								$existRecordID = $this->AdminfunctionsPlugin()->validateduplicateCSV('view_message_template',$detailData['from_name'],'from_name',$this->dbAdapter,$data[0]);	
								if($existRecordID > 0)
								{
									continue;
								}
								$existRecordID = $data[0]; 
								if($existRecordID > 0)
								{
									$saveDataArray['date_updated'] = date('Y-m-d H:i:s');		
									$projectTable->update($saveDataArray,array("id=".$existRecordID));
									
									$detailData['date_updated'] = date('Y-m-d H:i:s');
									$projectTableLocale->update($detailData,array("message_template_id=".$existRecordID,"locale_id=".$this->config['global_locale_id']));	
								}
								else
								{
									
									$saveDataArray['organization_id'] = self::$Aula_OrgID;
									$saveDataArray['owner_organization_id'] = self::$Aula_OwnerOrgID;
									$saveDataArray['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;								
									$projectTable->insert($saveDataArray);	
									$existRecordID = $projectTable->lastInsertValue;	
									
									$detailData['owner_organization_id'] = self::$Aula_OwnerOrgID;
									$detailData['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;	
									$detailData['message_template_id'] = $existRecordID;
									$detailData['locale_id'] = $this->config['global_locale_id'];							
									$projectTableLocale->insert($detailData);	
								}
								foreach($activeLocalesArray as $locale)
								{
									if($locale['id'] == $this->config['global_locale_id'])
										continue;
										
									$existLocaleRecordID = $this->AdminfunctionsPlugin()->validateduplicateLocaleCSV('message_template_locale',$existRecordID,'message_template_id','id',$this->dbAdapter,$locale['id'],'locale_id'); 
									
									$detailData = array();
									$detailData['from_name'] 	= $data[$column_index++];
									$detailData['description'] 	= $data[$column_index++];
									$detailData['to_name'] 		= $data[$column_index++];
									$detailData['subject'] 		= $data[$column_index++];
									
									if($existLocaleRecordID > 0)
									{										
										$detailData['date_updated'] = date('Y-m-d H:i:s');
										$projectTableLocale->update($detailData,array("id=".$existLocaleRecordID));
									}
									else
									{										
										$detailData['owner_organization_id'] = self::$Aula_OwnerOrgID;
										$detailData['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;	
										$detailData['message_template_id'] = $existRecordID;
										$detailData['locale_id'] = $locale['id'];							
										$projectTableLocale->insert($detailData);	
									}
								
								}
							}
						}
						$result['status'] = 'OK';
						$result['message1'] = 'Csv imported successfully.';
						$this->memCached->setItem('aula_templates_data','');
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
		
		$csvData .= "#ID,Message Type,Message For(Organization|Donor|Beneficiary),From Mobile Number,From Email,To Mobile Number,To Email,Published(Yes|No),";
		foreach($activeLocalesArray as $locale)
		{
			$csvData .= "From Name(".$locale['name']."),";
			$csvData .= "To Name(".$locale['name']."),";
			$csvData .= "Description(".$locale['name']."),";
			$csvData .= "Subject(".$locale['name']."),";
			
		}
		$csvData .= "\n";
		header('Content-Type: text/csv; charset=utf-8');
		header("Content-Disposition: attachment; filename=message_templates.csv");
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
			
			
			$this->AdminfunctionsPlugin()->validateduplicatelocale($tableName,$ID,$fieldName,$EDIT_ID,'message_template_id',$this->dbAdapter,$this->config);           
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
			
			if($this->memCached->hasItem('aula_templates_data') && is_array($this->memCached->getItem('aula_templates_data')))
			{
				$message_templatees = $this->memCached->getItem('aula_templates_data');
				$rowset[0] = $message_templatees[$iID];
			}
			else
			{
				$projectTable = new TableGateway('message_template', $this->dbAdapter);
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

            $projectTable = new TableGateway('message_template', $this->dbAdapter);
			$projectTableLocale = new TableGateway('message_template_locale', $this->dbAdapter);

            if ($this->request->getPost("pAction") == "DELETE") {
                $iMasterID = $this->request->getPost("KEY_ID");
				
				$projectTable->delete(array("id=".$iMasterID));
				$projectTableLocale->delete(array("message_template_id=".$iMasterID));
				$this->memCached->setItem('aula_templates_data','');
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
	 public function bulksaveAction()
    {        
		$tableName = 'message_template';
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
				$updateData['published'] = $this->setCheckboxValue($aData,'published'.$iMasterID,'Yes','No');
				
				$projectTable->update($updateData,array("id=".$iMasterID));				
			}
			$this->memCached->setItem('aula_templates_data','');
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

    public function saveAction()
    { 
		$activeLocalesArray = $this->AdminfunctionsPlugin()->getActiveLocales($this->dbAdapter);       
		$tableName = 'message_template';
		$tableNameLocale = 'message_template_locale';
        if ($this->request->isPost()) {

            $projectTable = new TableGateway($tableName,$this->dbAdapter);
			$projectTableLocale = new TableGateway($tableNameLocale,$this->dbAdapter);
			
			$aData = json_decode($this->request->getPost("FORM_DATA"));
			$aData = (array)$aData;			
			
			$aData['published'] = $this->setCheckboxValue($aData,'published','Yes','No');

			if ($this->request->getPost("pAction") == "ADD")
			{
				$masterData = array();
				$masterData['published'] 			= $aData['published'];
				$masterData['message_type_id'] 		= $aData['message_type_id'];
				$masterData['message_type'] 		= $aData['message_type'];
				$masterData['from_mobile_number'] 	= $aData['from_mobile_number'];
				$masterData['from_email'] 			= $aData['from_email'];
				$masterData['to_mobile_number'] 	= $aData['to_mobile_number'];
				$masterData['to_email'] 			= $aData['to_email'];
				
				$masterData['organization_id'] = self::$Aula_OrgID;
				$masterData['owner_organization_id'] = self::$Aula_OwnerOrgID;
				$masterData['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;
				
				
				
				$projectTable->insert($masterData);	
				$iMasterID = $projectTable->lastInsertValue;	
				foreach($activeLocalesArray as $locale)
				{
					$detailData = array();
					$detailData['from_name'] 	= $aData['from_name_'.$locale['id']];
					$detailData['description'] 	= $aData['description_'.$locale['id']];
					$detailData['to_name'] 		= $aData['to_name_'.$locale['id']];
					$detailData['subject'] 		= $aData['subject_'.$locale['id']];
					$detailData['locale_id'] 	= $locale['id'];
					$detailData['message_template_id'] = $iMasterID;
					
					$detailData['owner_organization_id'] = self::$Aula_OwnerOrgID;
					$detailData['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;
				 
					$projectTableLocale->insert($detailData);	
					$projectTableLocale->lastInsertValue;
				}									
				$result['DBStatus'] = 'OK';
			}
			else  if($this->request->getPost("pAction") == "EDIT")
			{			
				$iMasterID=$aData['MASTER_KEY_ID'];				
				
				$masterData = array();
				$masterData['published'] 			= $aData['published'];
				$masterData['message_type_id'] 		= $aData['message_type_id'];
				$masterData['message_type'] 		= $aData['message_type'];
				$masterData['from_mobile_number'] 	= $aData['from_mobile_number'];
				$masterData['from_email'] 			= $aData['from_email'];
				$masterData['to_mobile_number'] 	= $aData['to_mobile_number'];
				$masterData['to_email'] 			= $aData['to_email'];
				$masterData['date_updated'] 		= date('Y-m-d H:i:s');
				
				$projectTable->update($masterData,array("id=".$iMasterID));
				foreach($activeLocalesArray as $locale)
				{
					$detailData = array();
					$detailData['from_name'] 	= $aData['from_name_'.$locale['id']];
					$detailData['description'] 	= $aData['description_'.$locale['id']];
					$detailData['to_name'] 		= $aData['to_name_'.$locale['id']];
					$detailData['subject'] 		= $aData['subject_'.$locale['id']];
					
					$rowset = $projectTableLocale->select(array("message_template_id=".$iMasterID,"locale_id=".$locale['id']));
					$rowset = $rowset->toArray();
					if(isset($rowset[0]['id']) && $rowset[0]['id'] > 0 ) 
					{					
						$detailData['date_updated'] = date('Y-m-d H:i:s');
						$projectTableLocale->update($detailData,array("id=".$rowset[0]['id']));						
					} 
					else 
					{
						$detailData['locale_id'] 	= $locale['id'];
						$detailData['message_template_id'] = $iMasterID;
						$detailData['owner_organization_id'] = self::$Aula_OwnerOrgID;
						$detailData['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;
						$projectTableLocale->insert($detailData);	
					}
					
				}									
				$result['DBStatus'] = 'OK';
			}
			$this->memCached->setItem('aula_templates_data','');
        }
        else
        {
            $result['DBStatus'] = 'ERR';
        }

        $result = json_encode($result);
        echo $result;
        exit;
    }
	public function getmessagetemplatesAction() 
	  {                
		$sql="select id as id,from_name as name from view_message_template where published='Yes' ";		        
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
