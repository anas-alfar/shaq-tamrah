<?php
namespace Aula_Adminpanel\Controller;

use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Db\Sql\Sql as Sql;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Adapter\AdapterInterface;

class BeneficiaryController extends AbstractActionController
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
		$aColumns = array( '`id`','`id`','`family_name`','`sequence`','`family_book_number`','`status`','`country_name`','`visibility`');
		if(!($this->memCached->hasItem('aula_beneficiary_data')) || !is_array($this->memCached->getItem('aula_beneficiary_data')))
		{	
			$sTable = 'view_beneficiary';
		
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
					$sQuery_locale 		= "SELECT family_name,intro_text FROM beneficiary_locale WHERE locale_id = '".$locale['id']."' AND beneficiary_id = '".$aRow['id']."' ";
					$statement_locale	= $this->dbAdapter->createStatement($sQuery_locale, $optionalParameters);        
					$resultData_locale	= $statement_locale->execute();        
					$resultSet_locale	= new ResultSet; 			   
					$resultSet_locale->initialize($resultData_locale);        
					$rowset_locale		= $resultSet_locale->toArray();
					$aRow['family_name_'.$locale['id']] = $rowset_locale[0]['family_name'];
					$aRow['intro_text_'.$locale['id']] = $rowset_locale[0]['intro_text'];
				}
				$rowsetCache[$aRow['id']] = $aRow;
			}
			$this->memCached->setItem('aula_beneficiary_data',$rowsetCache);
		}
			
		$rowset = $this->memCached->getItem('aula_beneficiary_data');
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
	public function uploadavatarAction()
    {
        $aData = (array)$aData;
		
        if ($this->request->isPost()) {

            $file = $_FILES['avatar'];
            $filename = $_FILES['avatar']['name'];
            //$ext = pathinfo($filename, PATHINFO_EXTENSION);
			

            
			$filename = rand(0,999).$filename;
			$myImagePath =  $this->config['site_dir_path']['public_dir_path']."uploads/localeicons/".$filename;
            //$myImagePath_DB =  "../public/uploads/$filename";
			
			/*$size = $_FILES["image"]['tmp_name'];
			list($width, $height) = getimagesize($size);
			
			if($width > "180" || $height > "70") {
				echo "Error : image size must be 180 x 70 pixels.";
				exit;
			}*/
			

            if (!move_uploaded_file($file['tmp_name'], $myImagePath)) {
                $result['status'] = 'ERR';
                $result['message1'] = 'Unable to save file![signature]';
            } else {
                $result['status'] = 'OK';
                $result['message1'] = 'Done';				
				$result['avatar'] = $filename;

            }

            //$data['logo_file']=$myImagePath_DB;
			//$_REQUEST['logohidden']=$myImagePath_DB;
            //$status=$projectTable->update($data,array('id' => ));


        }

        $result = json_encode($result);
        echo $result;
        exit;
    }
	
	
	public function exportcsvAction()
	{
		if ($this->request->isPost()) 
		{
			$activeLocalesArray = $this->AdminfunctionsPlugin()->getActiveLocales($this->dbAdapter);		
			
			$csvData = '';		
			$sql = "SELECT * FROM view_beneficiary WHERE 1 = 1";
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
			$csvData .= "#ID,Sequence,Family Book Number,Status(New|Draft|In Review|Moved|Approved|Rejected|Duplicate|Deleted),Notes,Options,Country,Visibility,";
			foreach($activeLocalesArray as $locale)
			{
				$csvData .= "Family Name(".$locale['name']."),";
				$csvData .= "Intro Text(".$locale['name']."),";
				
			}
			$csvData .= "\n";
				
			
			foreach($rowset as $row)
			{
				
				$csvData .= $row['id'].",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['sequence']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['family_book_number']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['status']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['notes']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['options']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['country_name']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['visibility']).",";
				foreach($activeLocalesArray as $locale)
					{
						$sQuery_locale1 		= "SELECT family_name,intro_text FROM beneficiary_locale WHERE locale_id = '".$locale['id']."' AND beneficiary_id = '".$row['id']."' ";
						$statement_locale	= $this->dbAdapter->createStatement($sQuery_locale1, $optionalParameters);        
						$resultData_locale	= $statement_locale->execute();        
						$resultSet_locale	= new ResultSet; 			   
						$resultSet_locale->initialize($resultData_locale);        
						$rowset_locale		= $resultSet_locale->toArray();
						$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($rowset_locale[0]['family_name']).",";
						$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($rowset_locale[0]['intro_text']).",";
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
        $projectTable = new TableGateway('beneficiary',$this->dbAdapter);
		$projectTableLocale = new TableGateway('beneficiary_locale',$this->dbAdapter);
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
							if($data[1] != "" && $data[2] != "" && $data[3] != ""&& $data[4] != ""&& $data[5] != ""&& $data[6] != ""&& $data[7] != "" && $data[8] != "")
							{
								$saveDataArray = array();
								$column_index = 1;
							 	
								
								
								
								
								$saveDataArray['sequence'] 				= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$saveDataArray['family_book_number'] 	= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$saveDataArray['status'] 				= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$saveDataArray['notes'] 				= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$saveDataArray['options'] 				= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$getCountryID = $this->AdminfunctionsPlugin()->validateduplicateLocaleCSV('country_locale',$this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]),'name','country_id',$this->dbAdapter,$this->config['global_locale_id'],'locale_id');
								$saveDataArray['country_id']			= $getCountryID;
								$saveDataArray['visibility'] 			= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								
								
								$detailData = array();
								$detailData['family_name'] = $data[$column_index++];
								$detailData['intro_text'] = $data[$column_index++];
								
								$existRecordID = $data[0]; 
								if($existRecordID > 0)
								{
									$saveDataArray['date_updated'] = date('Y-m-d H:i:s');		
									$projectTable->update($saveDataArray,array("id=".$existRecordID));
									
									$detailData['date_updated'] = date('Y-m-d H:i:s');
									$projectTableLocale->update($detailData,array("beneficiary_id=".$existRecordID,"locale_id=".$this->config['global_locale_id']));	
								}
								else
								{
									$existRecordID = $this->AdminfunctionsPlugin()->validateduplicateCSV('view_beneficiary',$detailData['family_name'],'family_name',$this->dbAdapter);	
									if($existRecordID > 0)
									{
										continue;
									}
									$saveDataArray['owner_organization_id'] = self::$Aula_OwnerOrgID;
									$saveDataArray['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;								
									$projectTable->insert($saveDataArray);	
									$existRecordID = $projectTable->lastInsertValue;	
									
									$detailData['owner_organization_id'] = self::$Aula_OwnerOrgID;
									$detailData['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;	
									$detailData['beneficiary_id'] = $existRecordID;
									$detailData['locale_id'] = $this->config['global_locale_id'];							
									$projectTableLocale->insert($detailData);	
								}
								foreach($activeLocalesArray as $locale)
								{
									if($locale['id'] == $this->config['global_locale_id'])
										continue;
										
									$existLocaleRecordID = $this->AdminfunctionsPlugin()->validateduplicateLocaleCSV('beneficiary_locale',$existRecordID,'beneficiary_id','id',$this->dbAdapter,$locale['id'],'locale_id'); 
									
									$detailData = array();
									$detailData['family_name'] = $data[$column_index++];
									$detailData['intro_text'] = $data[$column_index++];
									
									
									if($existLocaleRecordID > 0)
									{										
										$detailData['date_updated'] = date('Y-m-d H:i:s');
										$projectTableLocale->update($detailData,array("id=".$existLocaleRecordID));
									}
									else
									{										
										$detailData['owner_organization_id'] = self::$Aula_OwnerOrgID;
										$detailData['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;	
										$detailData['beneficiary_id'] = $existRecordID;
										$detailData['locale_id'] = $locale['id'];							
										$projectTableLocale->insert($detailData);	
									}
								
								}
							}
						}
						$result['status'] = 'OK';
						$result['message1'] = 'Csv imported successfully.';
						$this->memCached->setItem('aula_beneficiary_data','');
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
		
		$csvData .= "#ID,Sequence,Family Book Number,Status(New|Draft|In Review|Moved|Approved|Rejected|Duplicate|Deleted),Notes,Options,Country,Visibility,";
		foreach($activeLocalesArray as $locale)
		{
				$csvData .= "Family Name(".$locale['name']."),";
				$csvData .= "Intro Text(".$locale['name']."),";
			
		}
		$csvData .= "\n";
		header('Content-Type: text/csv; charset=utf-8');
		header("Content-Disposition: attachment; filename=beneficiary.csv");
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
			
			
			$this->AdminfunctionsPlugin()->validateduplicatelocale($tableName,$ID,$fieldName,$EDIT_ID,'beneficiary_id',$this->dbAdapter,$this->config);           
        }
		else {
			$result1['DBStatus'] = 'ERR';
			$result1 = json_encode($result1);
			echo $result1;
		}
        exit;
    }
	public function validateduplicateDetailAction()
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
			
			if($this->memCached->hasItem('aula_beneficiary_data') && is_array($this->memCached->getItem('aula_beneficiary_data')))
			{
				$beneficiaryes = $this->memCached->getItem('aula_beneficiary_data');
				$rowset[0] = $beneficiaryes[$iID];
			}
			else
			{
				$projectTable = new TableGateway('beneficiary', $this->dbAdapter);
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

            $projectTable = new TableGateway('beneficiary', $this->dbAdapter);
			$projectTableLocale = new TableGateway('beneficiary_locale', $this->dbAdapter);

            if ($this->request->getPost("pAction") == "DELETE") {
                $iMasterID = $this->request->getPost("KEY_ID");
				
				$projectTable->delete(array("id=".$iMasterID));
				$projectTableLocale->delete(array("beneficiary_id=".$iMasterID));
				$this->memCached->setItem('aula_beneficiary_data','');
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
		$tableName = 'beneficiary';
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
				$updateData['visibility'] = $this->setCheckboxValue($aData,'visibility'.$iMasterID,'Yes','No');
				
				$projectTable->update($updateData,array("id=".$iMasterID));				
			}
			$this->memCached->setItem('aula_beneficiary_data','');
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
		$tableName = 'beneficiary';
		$tableNameLocale = 'beneficiary_locale';
		$tableNameHasProfile = 'beneficiary_has_profile';
		$tableNameProfile = 'beneficiary_profile';
        if ($this->request->isPost()) {

            $projectTable = new TableGateway($tableName,$this->dbAdapter);
			$projectTableLocale = new TableGateway($tableNameLocale,$this->dbAdapter);
			$projectTableHasProfile = new TableGateway($tableNameHasProfile,$this->dbAdapter);
			$projectTableProfile = new TableGateway($tableNameProfile,$this->dbAdapter);
			
			$aData = json_decode($this->request->getPost("FORM_DATA"));
			$aData = (array)$aData;			
			
			$aData['visibility'] = $this->setCheckboxValue($aData,'visibility','Yes','No');

			if ($this->request->getPost("pAction") == "ADD")
			{
				$masterData = array();
				//$masterData['sequence'] 			= $aData['sequence'];
				$masterData['family_book_number'] 	= $aData['family_book_number'];
				$masterData['status'] 				= 'Draft';
				$masterData['country_id'] 			= $aData['country_id'];
				$masterData['notes'] 				= $aData['notes'];
				$masterData['options'] 				= $aData['options'];
				$masterData['visibility'] 			= $aData['visibility'];
				
				$masterData['owner_organization_id'] = self::$Aula_OwnerOrgID;
				$masterData['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;
				
				$projectTable->insert($masterData);	
				$iMasterID = $projectTable->lastInsertValue;	
				foreach($activeLocalesArray as $locale)
				{
					$detailData = array();
					$detailData['family_name'] = $aData['family_name_'.$locale['id']];
					$detailData['intro_text'] = $aData['intro_text_'.$locale['id']];
					$detailData['locale_id'] = $locale['id'];
					$detailData['beneficiary_id'] = $iMasterID;
					
					$detailData['owner_organization_id'] = self::$Aula_OwnerOrgID;
					$detailData['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;
				
					$projectTableLocale->insert($detailData);	
				}		
				$profileData = array();
				$profileData['beneficiary_id'] = $iMasterID;
				$profileData['beneficiary_profile_id'] = $aData['beneficiary_profile_id'];
				$profileData['status'] = 'Draft';
					
				$profileData['date_added'] = date('Y-m-d H:i:s');
				$profileData['owner_organization_id'] = self::$Aula_OwnerOrgID;
				$profileData['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;
				
				$projectTableHasProfile->insert();	
				
				$rowsetProfile = $projectTableProfile->select(['id' => $aData['beneficiary_profile_id'] ]);						
				$rowsetProfile = $rowsetProfile->toArray();
				
				$result['DBStatus'] = 'OK';
				$result['MY_ID'] = $iMasterID;
				$result['ALLOWED_PROFILE_LIST'] = $rowsetProfile[0];
				
			}
			else  if($this->request->getPost("pAction") == "EDIT")
			{			
				$iMasterID=$aData['MASTER_KEY_ID'];				
				
				$masterData = array();
				$masterData['family_book_number'] 	= $aData['family_book_number'];
				$masterData['country_id'] 		= $aData['country_id'];
				$masterData['visibility'] 	= $aData['visibility'];
				$masterData['date_updated'] = date('Y-m-d H:i:s');
				
				$projectTable->update($masterData,array("id=".$iMasterID));
				foreach($activeLocalesArray as $locale)
				{
					$detailData = array();
					$detailData['family_name'] = $aData['family_name_'.$locale['id']];
					$detailData['intro_text'] = $aData['intro_text_'.$locale['id']];
					$detailData['date_updated'] = date('Y-m-d H:i:s');
					
					$projectTableLocale->update($detailData,array("beneficiary_id=".$iMasterID,"locale_id=".$locale['id']));
				}	
				
				$rowsetProfile = $projectTableProfile->select(['id' => $aData['beneficiary_profile_id'] ]);					
				$rowsetProfile = $rowsetProfile->toArray();
												
				$result['DBStatus'] = 'OK';
				$result['MY_ID'] = $iMasterID;
				$result['ALLOWED_PROFILE_LIST'] = $rowsetProfile[0];
			}
			$this->memCached->setItem('aula_beneficiary_data','');
        }
        else
        {
            $result['DBStatus'] = 'ERR';
        }

        $result = json_encode($result);
        echo $result;
        exit;
    }
	public function getbeneficiaryAction() 
	{                
		$sql="select beneficiary_id as id,family_name as name from beneficiary_locale where locale_id = '".$this->global_locale_id."' ";		        
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
	
	/********* BASIC DETAIL STEP **********/	
	public function saveBasicDetailAction()
	{    
		$tableName = 'beneficiary_profile_details';
        if ($this->request->isPost()) {

			if ($this->request->getPost("beneficiaryID") > 0)
			{
				$beneficiaryID = $this->request->getPost("beneficiaryID");
				$projectTable = new TableGateway($tableName,$this->dbAdapter);
				
				$aData = json_decode($this->request->getPost("FORM_DATA"));
				$aData = (array)$aData;			
				
				$aData['has_paterfamilias'] = $this->setCheckboxValue($aData,'has_paterfamilias','Yes','No');
				$aData['has_family_members'] = $this->setCheckboxValue($aData,'has_family_members','Yes','No');
				$aData['is_father_alive'] = $this->setCheckboxValue($aData,'is_father_alive','Yes','No');
				$aData['is_mother_alive'] = $this->setCheckboxValue($aData,'is_mother_alive','Yes','No');
				$aData['has_supplies_card'] = $this->setCheckboxValue($aData,'has_supplies_card','Yes','No');
				
				$rowset = $projectTable->select(['beneficiary_id' => $beneficiaryID]);
				$rowset = $rowset->toArray();
				if($rowset[0]['id'] > 0)
				{
					$aData['date_updated'] = date('Y-m-d H:i:s');
					$projectTable->update($aData,['id' => $rowset[0]['id']]);
				}
				else
				{
					$aData['beneficiary_id'] = $beneficiaryID;
					$aData['date_added'] = date('Y-m-d H:i:s');
					
					$aData['owner_organization_id'] = self::$Aula_OwnerOrgID;
					$aData['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;
					$projectTable->insert($aData);
				}
				$result['DBStatus'] = 'OK';
			}
			else
			{
				 $result['DBStatus'] = 'ERR';
			}
		}
        else
        {
            $result['DBStatus'] = 'ERR';
        }

        $result = json_encode($result);
        echo $result;
        exit;
	}
		
	/********* FAMILY DETAIL STEP **********/
	public function listFamilyDetailAction()
	{
		$activeLocalesArray = $this->AdminfunctionsPlugin()->getActiveLocales($this->dbAdapter);
		$aColumns = array( '`id`','`avatar`','`first_name`','`second_name`','`mobile_number`','`email`');
			
		$sTable = 'view_beneficiary_profile_family';
	
		/* Indexed column (used for fast and accurate table cardinality) */
		$sIndexColumn = "id";  
		
		$sWhere = " WHERE beneficiary_id = '".$this->request->getPost("beneficiaryID")."' ";
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
		exit;
	}	
	public function saveFamilyDetailAction()
	{  
		$activeLocalesArray = $this->AdminfunctionsPlugin()->getActiveLocales($this->dbAdapter);       
		$tableName = 'beneficiary_profile_family';
		$tableNameLocale = 'beneficiary_profile_family_locale';
        if ($this->request->isPost()) {

			if ($this->request->getPost("beneficiaryID") > 0)
			{
				$beneficiaryID = $this->request->getPost("beneficiaryID");
				$projectTable = new TableGateway($tableName,$this->dbAdapter);
				$projectTableLocale = new TableGateway($tableNameLocale,$this->dbAdapter);
				
				$aData = json_decode($this->request->getPost("FORM_DATA"));
				$aData = (array)$aData;	
				
				if($aData['date_of_birth'] != '') {
					$date_of_birth_ar = explode("/",$aData['date_of_birth']);
					$date_of_birth = $date_of_birth_ar[2].'-'.$date_of_birth_ar[0].'-'.$date_of_birth_ar[1];
					$aData['date_of_birth'] = $date_of_birth;
				}
				else {
					unset($aData['date_of_birth']);
				}
				
				if($aData['death_date'] != '') {
					$death_date_ar = explode("/",$aData['death_date']);
					$death_date = $death_date_ar[2].'-'.$death_date_ar[0].'-'.$death_date_ar[1];
					$aData['death_date'] = $death_date;
				}
				else {
					unset($aData['death_date']);
				}
				
				
				$masterData = array();
				$masterData['ssn'] 												= $aData['ssn'];
				$masterData['phone_number'] 									= $aData['phone_number'];
				$masterData['mobile_number'] 									= $aData['mobile_number'];
				$masterData['email'] 											= $aData['email'];
				$masterData['nationality_id'] 									= $aData['nationality_id'];
				$masterData['country_id'] 										= $aData['country_id'];
				$masterData['city_id'] 											= $aData['city_id'];
				$masterData['date_of_birth'] 									= $aData['date_of_birth'];
				$masterData['beneficiary_relation_id'] 							= $aData['beneficiary_relation_id'];
				$masterData['marital_status_id'] 								= $aData['marital_status_id'];
				$masterData['education_level_id'] 								= $aData['education_level_id'];
				$masterData['medical_condition_id'] 							= $aData['medical_condition_id'];
				$masterData['beneficiary_profile_family_profession_id'] 		= $aData['beneficiary_profile_family_profession_id'];
				$masterData['death_date'] 										= $aData['death_date'];
				$masterData['death_reason_id'] 									= $aData['death_reason_id'];
				$masterData['beneficiary_id'] 									= $beneficiaryID;
	
				if ($this->request->getPost("pAction") == "ADD")
				{					
					$masterData['owner_organization_id'] = self::$Aula_OwnerOrgID;
					$masterData['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;
					$masterData['date_added'] = date('Y-m-d H:i:s');
					
					$projectTable->insert($masterData);	
					$iMasterID = $projectTable->lastInsertValue;
					$result['DBStatus'] = 'OK';					
				}
				else  if($this->request->getPost("pAction") == "EDIT")
				{			
					$iMasterID=$aData['MASTER_KEY_ID'];	
					$masterData['date_updated'] = date('Y-m-d H:i:s');
					
					$projectTable->update($masterData,array("id=".$iMasterID));
																		
					$result['DBStatus'] = 'OK';
				}
				foreach($activeLocalesArray as $locale)
				{
					$detailData = array();
					$detailData['first_name'] = $aData['first_name_'.$locale['id']];
					$detailData['second_name'] = $aData['second_name_'.$locale['id']];
					$detailData['third_name'] = $aData['third_name_'.$locale['id']];
					$detailData['last_name'] = $aData['last_name_'.$locale['id']];
					$detailData['address'] = $aData['address_'.$locale['id']];
					
					$rowset = $projectTableLocale->select([ "beneficiary_profile_family_id" => $iMasterID, "locale_id" => $locale['id'] ]);
					$rowset = $rowset->toArray();
					if($rowset[0]['id'] > 0)
					{
						$detailData['date_updated'] = date('Y-m-d H:i:s');						
						$projectTableLocale->update($detailData,['id' => $rowset[0]['id'] ]);
					}
					else
					{							
						$detailData['locale_id'] = $locale['id'];
						$detailData['beneficiary_id'] = $beneficiaryID;
						$detailData['beneficiary_profile_family_id'] = $iMasterID;
						$detailData['date_added'] = date('Y-m-d H:i:s');
						
						$detailData['owner_organization_id'] = self::$Aula_OwnerOrgID;
						$detailData['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;
					
						$projectTableLocale->insert($detailData);	
					}
					
				}
			}
			else
			{
				$result['DBStatus'] = 'ERR';
			}
		}
        else
        {
            $result['DBStatus'] = 'ERR';
        }

        $result = json_encode($result);
        echo $result;
        exit;
    
	}	
	public function getrecFamilyDetailAction()
    {
        $activeLocalesArray = $this->AdminfunctionsPlugin()->getActiveLocales($this->dbAdapter);       
		$recs=array();
        if ($this->request->isPost()) {
            
			$iID = $this->request->getPost("KEY_ID");
			
			$projectTable = new TableGateway('beneficiary_profile_family', $this->dbAdapter);
			$rowset = $projectTable->select(array('id' => $iID));
			$rowset = $rowset->toArray();			

            foreach ($rowset as $record)
			{
             	foreach($activeLocalesArray as $locale)
				{
					$sQuery_locale 		= "SELECT first_name,second_name,third_name,last_name,address FROM beneficiary_profile_family_locale WHERE locale_id = '".$locale['id']."' AND  	beneficiary_profile_family_id = '".$record['id']."' ";
					$statement_locale	= $this->dbAdapter->createStatement($sQuery_locale, $optionalParameters);        
					$resultData_locale	= $statement_locale->execute();        
					$resultSet_locale	= new ResultSet; 			   
					$resultSet_locale->initialize($resultData_locale);        
					$rowset_locale		= $resultSet_locale->toArray();
					
					$record['first_name_'.$locale['id']] = $rowset_locale[0]['first_name'];
					$record['second_name_'.$locale['id']] = $rowset_locale[0]['second_name'];
					$record['third_name_'.$locale['id']] = $rowset_locale[0]['third_name'];
					$record['last_name_'.$locale['id']] = $rowset_locale[0]['last_name'];
					$record['address_'.$locale['id']] = $rowset_locale[0]['address'];
				}
				$date_of_birth_ar = explode("-",$record['date_of_birth']);
				$record['date_of_birth'] = $date_of_birth_ar[1].'/'.$date_of_birth_ar[2].'/'.$date_of_birth_ar[0];				
				
				$death_date_ar = explode("-",$record['death_date']);
				$record['death_date'] = $death_date_ar[1].'/'.$death_date_ar[2].'/'.$death_date_ar[0];
				
			    $recs[] = $record;
			}
            $result['data'] = $recs;
            $result['recordsTotal'] = count($recs);
            $result['DBStatus'] = 'OK';

            $result = json_encode($result);
            echo $result;
            exit;
        }
    }		
	public function deleteFamilyDetailAction()
    {        
        if ($this->request->isPost()) {

            $projectTable = new TableGateway('beneficiary_profile_family', $this->dbAdapter);
			$projectTableLocale = new TableGateway('beneficiary_profile_family_locale', $this->dbAdapter);

            if ($this->request->getPost("pAction") == "DELETE") {
                $iMasterID = $this->request->getPost("KEY_ID");
				
				$projectTable->delete(array("id=".$iMasterID));
				$projectTableLocale->delete(array("beneficiary_profile_family_id=".$iMasterID));
                $result['DBStatus'] = 'OK';
                $result = json_encode($result);
                echo $result;
                exit;
            }
        }
    }
	public function getFamilyDetailAction()
	{
		$sql="select id as id,concat(first_name,concat(' ',second_name)) as name from view_beneficiary_profile_family where beneficiary_id = '".$this->request->getPost("beneficiaryID")."' ";		        
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
	
	/********* FAMILY EXTRA DETAIL STEP **********/
	public function listFamilyExtraDetailAction()
	{
		$activeLocalesArray = $this->AdminfunctionsPlugin()->getActiveLocales($this->dbAdapter);
		$aColumns = array( '`id`','first_name','`flag_name`','`flag_value`');
			
		$sTable = 'view_beneficiary_profile_family_has_flag';
	
		/* Indexed column (used for fast and accurate table cardinality) */
		$sIndexColumn = "id";  
		
		$sWhere = " WHERE beneficiary_id = '".$this->request->getPost("beneficiaryID")."' ";
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
					case 'concat(first_name,concat(" ",second_name)) as family_name' :						
						$row[] = $aRow['family_name'];
						break;
					default :
						 $row[] = $aRow[ $aColumns[$i] ];
				}
			}
			$output['aaData'][] = $row; 
		}
		
		echo json_encode( $output ); 
		exit;
	}	
	public function saveFamilyExtraDetailAction()
	{  
		$activeLocalesArray = $this->AdminfunctionsPlugin()->getActiveLocales($this->dbAdapter);       
		$tableName = 'beneficiary_profile_family_has_flag';
        if ($this->request->isPost()) {

			if ($this->request->getPost("beneficiaryID") > 0)
			{
				$beneficiaryID = $this->request->getPost("beneficiaryID");
				$projectTable = new TableGateway($tableName,$this->dbAdapter);
				
				$aData = json_decode($this->request->getPost("FORM_DATA"));
				$aData = (array)$aData;	
				
				$aData['flag_value'] = $this->setCheckboxValue($aData,'flag_value','Yes','No');
				
				$masterData = array();
				$masterData['beneficiary_profile_family_flag_id'] 				= $aData['beneficiary_profile_family_flag_id'];
				$masterData['flag_value'] 										= $aData['flag_value'];
				$masterData['beneficiary_profile_family_id'] 					= $aData['beneficiary_profile_family_id'];
				$masterData['beneficiary_id'] 									= $beneficiaryID;
	
				if ($this->request->getPost("pAction") == "ADD")
				{					
					$masterData['owner_organization_id'] = self::$Aula_OwnerOrgID;
					$masterData['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;
					$masterData['date_added'] = date('Y-m-d H:i:s');
					
					$projectTable->insert($masterData);	
					$iMasterID = $projectTable->lastInsertValue;
					$result['DBStatus'] = 'OK';					
				}
				else  if($this->request->getPost("pAction") == "EDIT")
				{			
					$iMasterID=$aData['MASTER_KEY_ID'];	
					$masterData['date_updated'] = date('Y-m-d H:i:s');
					
					$projectTable->update($masterData,array("id=".$iMasterID));
																		
					$result['DBStatus'] = 'OK';
				}
			}
			else
			{
				$result['DBStatus'] = 'ERR';
			}
		}
        else
        {
            $result['DBStatus'] = 'ERR';
        }

        $result = json_encode($result);
        echo $result;
        exit;
    
	}	
	public function getrecFamilyExtraDetailAction()
    {
        $activeLocalesArray = $this->AdminfunctionsPlugin()->getActiveLocales($this->dbAdapter);       
		$recs=array();
        if ($this->request->isPost()) {
            
			$iID = $this->request->getPost("KEY_ID");
			
			$projectTable = new TableGateway('beneficiary_profile_family_has_flag', $this->dbAdapter);
			$rowset = $projectTable->select(array('id' => $iID));
			$rowset = $rowset->toArray();			

            foreach ($rowset as $record)
			{             	
			    $recs[] = $record;
			}
            $result['data'] = $recs;
            $result['recordsTotal'] = count($recs);
            $result['DBStatus'] = 'OK';

            $result = json_encode($result);
            echo $result;
            exit;
        }
    }		
	public function deleteFamilyExtraDetailAction()
    {        
        if ($this->request->isPost()) {

            $projectTable = new TableGateway('beneficiary_profile_family_has_flag', $this->dbAdapter);

            if ($this->request->getPost("pAction") == "DELETE") {
                $iMasterID = $this->request->getPost("KEY_ID");
				
				$projectTable->delete(array("id=".$iMasterID));
                $result['DBStatus'] = 'OK';
                $result = json_encode($result);
                echo $result;
                exit;
            }
        }
    }
	
	/********* INCOME DETAIL STEP **********/
	public function listIncomeDetailAction()
	{
		$activeLocalesArray = $this->AdminfunctionsPlugin()->getActiveLocales($this->dbAdapter);
		$aColumns = array( '`id`','income_type','`amount`','`currency_name`','`exchange_rate`','`frequency`','`status`');
			
		$sTable = 'view_beneficiary_profile_income';
	
		/* Indexed column (used for fast and accurate table cardinality) */
		$sIndexColumn = "id";  
		
		$sWhere = " WHERE beneficiary_id = '".$this->request->getPost("beneficiaryID")."' ";
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
					case 'concat(first_name,concat(" ",second_name)) as family_name' :						
						$row[] = $aRow['family_name'];
						break;
					default :
						 $row[] = $aRow[ $aColumns[$i] ];
				}
			}
			$output['aaData'][] = $row; 
		}
		
		echo json_encode( $output ); 
		exit;
	}	
	public function saveIncomeDetailAction()
	{  
		$activeLocalesArray = $this->AdminfunctionsPlugin()->getActiveLocales($this->dbAdapter);       
		$tableName = 'beneficiary_profile_income';
        if ($this->request->isPost()) {

			if ($this->request->getPost("beneficiaryID") > 0)
			{
				$beneficiaryID = $this->request->getPost("beneficiaryID");
				$projectTable = new TableGateway($tableName,$this->dbAdapter);
				
				$aData = json_decode($this->request->getPost("FORM_DATA"));
				$aData = (array)$aData;	
				
				$masterData = array();
				$masterData['beneficiary_profile_income_type_id'] 				= $aData['beneficiary_profile_income_type_id'];
				$masterData['amount'] 											= $aData['amount'];
				$masterData['currency'] 										= $aData['currency'];
				$masterData['currency_exchange_rate_id'] 						= $aData['currency_exchange_rate_id'];
				$masterData['frequency'] 										= $aData['frequency'];
				$masterData['status'] 											= $aData['status'];
				$masterData['beneficiary_id'] 									= $beneficiaryID;
	
				if ($this->request->getPost("pAction") == "ADD")
				{					
					$masterData['owner_organization_id'] = self::$Aula_OwnerOrgID;
					$masterData['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;
					$masterData['date_added'] = date('Y-m-d H:i:s');
					
					$projectTable->insert($masterData);	
					$iMasterID = $projectTable->lastInsertValue;
					$result['DBStatus'] = 'OK';					
				}
				else  if($this->request->getPost("pAction") == "EDIT")
				{			
					$iMasterID=$aData['MASTER_KEY_ID'];	
					$masterData['date_updated'] = date('Y-m-d H:i:s');
					
					$projectTable->update($masterData,array("id=".$iMasterID));
																		
					$result['DBStatus'] = 'OK';
				}
			}
			else
			{
				$result['DBStatus'] = 'ERR';
			}
		}
        else
        {
            $result['DBStatus'] = 'ERR';
        }

        $result = json_encode($result);
        echo $result;
        exit;
    
	}	
	public function getrecIncomeDetailAction()
    {
        $activeLocalesArray = $this->AdminfunctionsPlugin()->getActiveLocales($this->dbAdapter);       
		$recs=array();
        if ($this->request->isPost()) {
            
			$iID = $this->request->getPost("KEY_ID");
			
			$projectTable = new TableGateway('beneficiary_profile_income', $this->dbAdapter);
			$rowset = $projectTable->select(array('id' => $iID));
			$rowset = $rowset->toArray();			

            foreach ($rowset as $record)
			{             	
			    $recs[] = $record;
			}
            $result['data'] = $recs;
            $result['recordsTotal'] = count($recs);
            $result['DBStatus'] = 'OK';

            $result = json_encode($result);
            echo $result;
            exit;
        }
    }		
	public function deleteIncomeDetailAction()
    {        
        if ($this->request->isPost()) {

            $projectTable = new TableGateway('beneficiary_profile_income', $this->dbAdapter);

            if ($this->request->getPost("pAction") == "DELETE") {
                $iMasterID = $this->request->getPost("KEY_ID");
				
				$projectTable->delete(array("id=".$iMasterID));
                $result['DBStatus'] = 'OK';
                $result = json_encode($result);
                echo $result;
                exit;
            }
        }
    }
	
	/********* SPENDING DETAIL STEP **********/
	public function listSpendingDetailAction()
	{
		$activeLocalesArray = $this->AdminfunctionsPlugin()->getActiveLocales($this->dbAdapter);
		$aColumns = array( '`id`','spending_type','`amount`','`currency_name`','`exchange_rate`','`frequency`');
			
		$sTable = 'view_beneficiary_profile_spending';
	
		/* Indexed column (used for fast and accurate table cardinality) */
		$sIndexColumn = "id";  
		
		$sWhere = " WHERE beneficiary_id = '".$this->request->getPost("beneficiaryID")."' ";
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
					case 'concat(first_name,concat(" ",second_name)) as family_name' :						
						$row[] = $aRow['family_name'];
						break;
					default :
						 $row[] = $aRow[ $aColumns[$i] ];
				}
			}
			$output['aaData'][] = $row; 
		}
		
		echo json_encode( $output ); 
		exit;
	}	
	public function saveSpendingDetailAction()
	{  
		$activeLocalesArray = $this->AdminfunctionsPlugin()->getActiveLocales($this->dbAdapter);       
		$tableName = 'beneficiary_profile_spending';
        if ($this->request->isPost()) {

			if ($this->request->getPost("beneficiaryID") > 0)
			{
				$beneficiaryID = $this->request->getPost("beneficiaryID");
				$projectTable = new TableGateway($tableName,$this->dbAdapter);
				
				$aData = json_decode($this->request->getPost("FORM_DATA"));
				$aData = (array)$aData;	
				
				$masterData = array();
				$masterData['beneficiary_profile_spending_type_id'] 			= $aData['beneficiary_profile_spending_type_id'];
				$masterData['amount'] 											= $aData['amount'];
				$masterData['currency'] 										= $aData['currency'];
				$masterData['currency_exchange_rate_id'] 						= $aData['currency_exchange_rate_id'];
				$masterData['frequency'] 										= $aData['frequency'];
				$masterData['beneficiary_id'] 									= $beneficiaryID;
	
				if ($this->request->getPost("pAction") == "ADD")
				{					
					$masterData['owner_organization_id'] = self::$Aula_OwnerOrgID;
					$masterData['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;
					$masterData['date_added'] = date('Y-m-d H:i:s');
					
					$projectTable->insert($masterData);	
					$iMasterID = $projectTable->lastInsertValue;
					$result['DBStatus'] = 'OK';					
				}
				else  if($this->request->getPost("pAction") == "EDIT")
				{			
					$iMasterID=$aData['MASTER_KEY_ID'];	
					$masterData['date_updated'] = date('Y-m-d H:i:s');
					
					$projectTable->update($masterData,array("id=".$iMasterID));
																		
					$result['DBStatus'] = 'OK';
				}
			}
			else
			{
				$result['DBStatus'] = 'ERR';
			}
		}
        else
        {
            $result['DBStatus'] = 'ERR';
        }

        $result = json_encode($result);
        echo $result;
        exit;
    
	}	
	public function getrecSpendingDetailAction()
    {
        $activeLocalesArray = $this->AdminfunctionsPlugin()->getActiveLocales($this->dbAdapter);       
		$recs=array();
        if ($this->request->isPost()) {
            
			$iID = $this->request->getPost("KEY_ID");
			
			$projectTable = new TableGateway('beneficiary_profile_spending', $this->dbAdapter);
			$rowset = $projectTable->select(array('id' => $iID));
			$rowset = $rowset->toArray();			

            foreach ($rowset as $record)
			{             	
			    $recs[] = $record;
			}
            $result['data'] = $recs;
            $result['recordsTotal'] = count($recs);
            $result['DBStatus'] = 'OK';

            $result = json_encode($result);
            echo $result;
            exit;
        }
    }		
	public function deleteSpendingDetailAction()
    {        
        if ($this->request->isPost()) {

            $projectTable = new TableGateway('beneficiary_profile_spending', $this->dbAdapter);

            if ($this->request->getPost("pAction") == "DELETE") {
                $iMasterID = $this->request->getPost("KEY_ID");
				
				$projectTable->delete(array("id=".$iMasterID));
                $result['DBStatus'] = 'OK';
                $result = json_encode($result);
                echo $result;
                exit;
            }
        }
    }
	
	/********* HOME DETAIL STEP **********/	
	public function saveHomeDetailAction()
	{    
		$activeLocalesArray = $this->AdminfunctionsPlugin()->getActiveLocales($this->dbAdapter);       
		$tableName = 'beneficiary_profile_home';
		$tableNameLocale = 'beneficiary_profile_home_locale';
        if ($this->request->isPost()) {

			if ($this->request->getPost("beneficiaryID") > 0)
			{
				$beneficiaryID = $this->request->getPost("beneficiaryID");
				$projectTable = new TableGateway($tableName,$this->dbAdapter);
				$projectTableLocale = new TableGateway($tableNameLocale,$this->dbAdapter);
				
				$aData = json_decode($this->request->getPost("FORM_DATA"));
				$aData = (array)$aData;			
				
				$masterData = array();
				$masterData['building_owner_phone_number'] 						= $aData['building_owner_phone_number'];
				$masterData['beneficiary_profile_home_construction_type_id'] 	= $aData['beneficiary_profile_home_construction_type_id'];
				$masterData['beneficiary_profile_home_contract_type_id'] 		= $aData['beneficiary_profile_home_contract_type_id'];
				$masterData['construction_area_in_square_meter'] 				= $aData['construction_area_in_square_meter'];
				$masterData['number_of_floors'] 								= $aData['number_of_floors'];
				$masterData['number_of_rooms'] 									= $aData['number_of_rooms'];
				$masterData['number_of_residents'] 								= $aData['number_of_residents'];
				
				
				$rowset = $projectTable->select(['beneficiary_id' => $beneficiaryID]);
				$rowset = $rowset->toArray();
				if($rowset[0]['id'] > 0)
				{
					$masterData['date_updated'] = date('Y-m-d H:i:s');
					$projectTable->update($masterData,['id' => $rowset[0]['id']]);
					$iMasterID = $rowset[0]['id'];
				}
				else
				{
					$masterData['beneficiary_id'] = $beneficiaryID;
					$masterData['date_added'] = date('Y-m-d H:i:s');
					
					$masterData['owner_organization_id'] = self::$Aula_OwnerOrgID;
					$masterData['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;
					$projectTable->insert($masterData);
					$iMasterID = $projectTable->lastInsertValue;
				}
				foreach($activeLocalesArray as $locale)
				{
					$detailData = array();
					$detailData['description'] = $aData['description_'.$locale['id']];
					$detailData['building_owner_name'] = $aData['building_owner_name_'.$locale['id']];
					
					$rowset = $projectTableLocale->select([ "beneficiary_profile_home_id" => $iMasterID, "locale_id" => $locale['id'] ]);
					$rowset = $rowset->toArray();
					if($rowset[0]['id'] > 0)
					{
						$detailData['date_updated'] = date('Y-m-d H:i:s');						
						$projectTableLocale->update($detailData,['id' => $rowset[0]['id'] ]);
					}
					else
					{							
						$detailData['locale_id'] = $locale['id'];
						$detailData['beneficiary_id'] = $beneficiaryID;
						$detailData['beneficiary_profile_home_id'] = $iMasterID;
						$detailData['date_added'] = date('Y-m-d H:i:s');
						
						$detailData['owner_organization_id'] = self::$Aula_OwnerOrgID;
						$detailData['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;
					
						$projectTableLocale->insert($detailData);	
					}
					
				}				
				$result['DBStatus'] = 'OK';
			}
			else
			{
				 $result['DBStatus'] = 'ERR';
			}
		}
        else
        {
            $result['DBStatus'] = 'ERR';
        }

        $result = json_encode($result);
        echo $result;
        exit;
	}
	
	/********* ALL OWNED DETAIL STEP **********/
	public function listAllOwnedDetailAction()
	{
		$activeLocalesArray = $this->AdminfunctionsPlugin()->getActiveLocales($this->dbAdapter);
		$aColumns = array( '`id`','asset_type','`asset_name`','`asset_condition`');
			
		$sTable = 'view_beneficiary_profile_asset';
	
		/* Indexed column (used for fast and accurate table cardinality) */
		$sIndexColumn = "id";  
		
		$sWhere = " WHERE beneficiary_id = '".$this->request->getPost("beneficiaryID")."' ";
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
					case 'concat(first_name,concat(" ",second_name)) as family_name' :						
						$row[] = $aRow['family_name'];
						break;
					default :
						 $row[] = $aRow[ $aColumns[$i] ];
				}
			}
			$output['aaData'][] = $row; 
		}
		
		echo json_encode( $output ); 
		exit;
	}	
	public function saveAllOwnedDetailAction()
	{  
		$activeLocalesArray = $this->AdminfunctionsPlugin()->getActiveLocales($this->dbAdapter);       
		$tableName = 'beneficiary_profile_asset';
        if ($this->request->isPost()) {

			if ($this->request->getPost("beneficiaryID") > 0)
			{
				$beneficiaryID = $this->request->getPost("beneficiaryID");
				$projectTable = new TableGateway($tableName,$this->dbAdapter);
				
				$aData = json_decode($this->request->getPost("FORM_DATA"));
				$aData = (array)$aData;	
				
				$masterData = array();
				$masterData['asset_type_id'] 			= $aData['asset_type_id'];
				$masterData['asset_id'] 				= $aData['asset_id'];
				$masterData['asset_condition_id'] 		= $aData['asset_condition_id'];
				$masterData['beneficiary_id'] 			= $beneficiaryID;
	
				if ($this->request->getPost("pAction") == "ADD")
				{					
					$masterData['owner_organization_id'] = self::$Aula_OwnerOrgID;
					$masterData['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;
					$masterData['date_added'] = date('Y-m-d H:i:s');
					
					$projectTable->insert($masterData);	
					$iMasterID = $projectTable->lastInsertValue;
					$result['DBStatus'] = 'OK';					
				}
				else  if($this->request->getPost("pAction") == "EDIT")
				{			
					$iMasterID=$aData['MASTER_KEY_ID'];	
					$masterData['date_updated'] = date('Y-m-d H:i:s');
					
					$projectTable->update($masterData,array("id=".$iMasterID));
																		
					$result['DBStatus'] = 'OK';
				}
			}
			else
			{
				$result['DBStatus'] = 'ERR';
			}
		}
        else
        {
            $result['DBStatus'] = 'ERR';
        }

        $result = json_encode($result);
        echo $result;
        exit;
    
	}	
	public function getrecAllOwnedDetailAction()
    {
        $activeLocalesArray = $this->AdminfunctionsPlugin()->getActiveLocales($this->dbAdapter);       
		$recs=array();
        if ($this->request->isPost()) {
            
			$iID = $this->request->getPost("KEY_ID");
			
			$projectTable = new TableGateway('beneficiary_profile_asset', $this->dbAdapter);
			$rowset = $projectTable->select(array('id' => $iID));
			$rowset = $rowset->toArray();			

            foreach ($rowset as $record)
			{             	
			    $recs[] = $record;
			}
            $result['data'] = $recs;
            $result['recordsTotal'] = count($recs);
            $result['DBStatus'] = 'OK';

            $result = json_encode($result);
            echo $result;
            exit;
        }
    }		
	public function deleteAllOwnedDetailAction()
    {        
        if ($this->request->isPost()) {

            $projectTable = new TableGateway('beneficiary_profile_asset', $this->dbAdapter);

            if ($this->request->getPost("pAction") == "DELETE") {
                $iMasterID = $this->request->getPost("KEY_ID");
				
				$projectTable->delete(array("id=".$iMasterID));
                $result['DBStatus'] = 'OK';
                $result = json_encode($result);
                echo $result;
                exit;
            }
        }
    }
	
	
	/********* ALL REQUIRED ASSETS STEP **********/
	public function listAllRequiredAssetsAction()
	{
		$activeLocalesArray = $this->AdminfunctionsPlugin()->getActiveLocales($this->dbAdapter);
		$aColumns = array( '`id`','`asset_name`','asset_type','asset_unit_type','`asset_condition`','`asset_quantity`','`status`');
			
		$sTable = 'view_beneficiary_profile_asset_required';
	
		/* Indexed column (used for fast and accurate table cardinality) */
		$sIndexColumn = "id";  
		
		$sWhere = " WHERE beneficiary_id = '".$this->request->getPost("beneficiaryID")."' ";
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
					case 'concat(first_name,concat(" ",second_name)) as family_name' :						
						$row[] = $aRow['family_name'];
						break;
					default :
						 $row[] = $aRow[ $aColumns[$i] ];
				}
			}
			$output['aaData'][] = $row; 
		}
		
		echo json_encode( $output ); 
		exit;
	}	
	public function saveAllRequiredAssetsAction()
	{  
		$activeLocalesArray = $this->AdminfunctionsPlugin()->getActiveLocales($this->dbAdapter);       
		$tableName = 'beneficiary_profile_asset_required';
        if ($this->request->isPost()) {

			if ($this->request->getPost("beneficiaryID") > 0)
			{
				$beneficiaryID = $this->request->getPost("beneficiaryID");
				$projectTable = new TableGateway($tableName,$this->dbAdapter);
				
				$aData = json_decode($this->request->getPost("FORM_DATA"));
				$aData = (array)$aData;	
				
				if($aData['beneficiary_profile_asset_received_date'] != '') {
					$beneficiary_profile_asset_received_date_ar = explode("/",$aData['beneficiary_profile_asset_received_date']);
					$beneficiary_profile_asset_received_date = $beneficiary_profile_asset_received_date_ar[2].'-'.$beneficiary_profile_asset_received_date_ar[0].'-'.$beneficiary_profile_asset_received_date_ar[1];
					$aData['beneficiary_profile_asset_received_date'] = $beneficiary_profile_asset_received_date;
				}
				
				$masterData = array();
				$masterData['asset_type_id'] 			= $aData['asset_type_id'];
				$masterData['asset_id'] 				= $aData['asset_id'];
				$masterData['asset_unit_id'] 			= $aData['asset_unit_id'];
				$masterData['asset_condition_id'] 		= $aData['asset_condition_id'];
				$masterData['asset_quantity'] 			= $aData['asset_quantity'];
				$masterData['status'] 					= $aData['status'];
				$masterData['beneficiary_profile_asset_received_id'] = $aData['beneficiary_profile_asset_received_id'];
				$masterData['beneficiary_profile_asset_received_date'] = $aData['beneficiary_profile_asset_received_date'];
				$masterData['beneficiary_id'] 			= $beneficiaryID;
	
				if ($this->request->getPost("pAction") == "ADD")
				{					
					$masterData['owner_organization_id'] = self::$Aula_OwnerOrgID;
					$masterData['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;
					$masterData['date_added'] = date('Y-m-d H:i:s');
					
					$projectTable->insert($masterData);	
					$iMasterID = $projectTable->lastInsertValue;
					$result['DBStatus'] = 'OK';					
				}
				else  if($this->request->getPost("pAction") == "EDIT")
				{			
					$iMasterID=$aData['MASTER_KEY_ID'];	
					$masterData['date_updated'] = date('Y-m-d H:i:s');
					
					$projectTable->update($masterData,array("id=".$iMasterID));
																		
					$result['DBStatus'] = 'OK';
				}
			}
			else
			{
				$result['DBStatus'] = 'ERR';
			}
		}
        else
        {
            $result['DBStatus'] = 'ERR';
        }

        $result = json_encode($result);
        echo $result;
        exit;
    
	}	
	public function getrecAllRequiredAssetsAction()
    {
        $activeLocalesArray = $this->AdminfunctionsPlugin()->getActiveLocales($this->dbAdapter);       
		$recs=array();
        if ($this->request->isPost()) {
            
			$iID = $this->request->getPost("KEY_ID");
			
			$projectTable = new TableGateway('beneficiary_profile_asset_required', $this->dbAdapter);
			$rowset = $projectTable->select(array('id' => $iID));
			$rowset = $rowset->toArray();			

            foreach ($rowset as $record)
			{  
				$date_ar1 = explode(" ",$record['beneficiary_profile_asset_received_date']);           	
			   	$date_ar = explode("-",$date_ar1[0]);
				$record['beneficiary_profile_asset_received_date'] = $date_ar[1].'/'.$date_ar[2].'/'.$date_ar[0];		
			    $recs[] = $record;
			}
            $result['data'] = $recs;
            $result['recordsTotal'] = count($recs);
            $result['DBStatus'] = 'OK';

            $result = json_encode($result);
            echo $result;
            exit;
        }
    }		
	public function deleteAllRequiredAssetsAction()
    {        
        if ($this->request->isPost()) {

            $projectTable = new TableGateway('beneficiary_profile_asset_required', $this->dbAdapter);

            if ($this->request->getPost("pAction") == "DELETE") {
                $iMasterID = $this->request->getPost("KEY_ID");
				
				$projectTable->delete(array("id=".$iMasterID));
                $result['DBStatus'] = 'OK';
                $result = json_encode($result);
                echo $result;
                exit;
            }
        }
    }
	
	/********* DISABLED DETAIL STEP **********/
	public function listDisabledDetailAction()
	{
		$activeLocalesArray = $this->AdminfunctionsPlugin()->getActiveLocales($this->dbAdapter);
		$aColumns = array( '`id`','`beneficiary_name`','disabled_type','disabled_reason');
			
		$sTable = 'view_beneficiary_profile_disabled';
	
		/* Indexed column (used for fast and accurate table cardinality) */
		$sIndexColumn = "id";  
		
		$sWhere = " WHERE beneficiary_id = '".$this->request->getPost("beneficiaryID")."' ";
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
					case 'concat(first_name,concat(" ",second_name)) as family_name' :						
						$row[] = $aRow['family_name'];
						break;
					default :
						 $row[] = $aRow[ $aColumns[$i] ];
				}
			}
			$output['aaData'][] = $row; 
		}
		
		echo json_encode( $output ); 
		exit;
	}	
	public function saveDisabledDetailAction()
	{  
		$activeLocalesArray = $this->AdminfunctionsPlugin()->getActiveLocales($this->dbAdapter);       
		$tableName = 'beneficiary_profile_disabled';
        if ($this->request->isPost()) {

			if ($this->request->getPost("beneficiaryID") > 0)
			{
				$beneficiaryID = $this->request->getPost("beneficiaryID");
				$projectTable = new TableGateway($tableName,$this->dbAdapter);
				
				$aData = json_decode($this->request->getPost("FORM_DATA"));
				$aData = (array)$aData;	
				
				$masterData = array();
				$masterData['beneficiary_profile_disabled_type_id'] 			= $aData['beneficiary_profile_disabled_type_id'];
				$masterData['beneficiary_profile_disabled_reason_id'] 			= $aData['beneficiary_profile_disabled_reason_id'];
				$masterData['beneficiary_profile_family_id'] 					= $aData['beneficiary_profile_family_id'];
				$masterData['beneficiary_id'] 									= $beneficiaryID;
	
				if ($this->request->getPost("pAction") == "ADD")
				{					
					$masterData['owner_organization_id'] = self::$Aula_OwnerOrgID;
					$masterData['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;
					$masterData['date_added'] = date('Y-m-d H:i:s');
					
					$projectTable->insert($masterData);	
					$iMasterID = $projectTable->lastInsertValue;
					$result['DBStatus'] = 'OK';					
				}
				else  if($this->request->getPost("pAction") == "EDIT")
				{			
					$iMasterID=$aData['MASTER_KEY_ID'];	
					$masterData['date_updated'] = date('Y-m-d H:i:s');
					
					$projectTable->update($masterData,array("id=".$iMasterID));
																		
					$result['DBStatus'] = 'OK';
				}
			}
			else
			{
				$result['DBStatus'] = 'ERR';
			}
		}
        else
        {
            $result['DBStatus'] = 'ERR';
        }

        $result = json_encode($result);
        echo $result;
        exit;
    
	}	
	public function getrecDisabledDetailAction()
    {
        $activeLocalesArray = $this->AdminfunctionsPlugin()->getActiveLocales($this->dbAdapter);       
		$recs=array();
        if ($this->request->isPost()) {
            
			$iID = $this->request->getPost("KEY_ID");
			
			$projectTable = new TableGateway('beneficiary_profile_disabled', $this->dbAdapter);
			$rowset = $projectTable->select(array('id' => $iID));
			$rowset = $rowset->toArray();			

            foreach ($rowset as $record)
			{             	
			    $recs[] = $record;
			}
            $result['data'] = $recs;
            $result['recordsTotal'] = count($recs);
            $result['DBStatus'] = 'OK';

            $result = json_encode($result);
            echo $result;
            exit;
        }
    }		
	public function deleteDisabledDetailAction()
    {        
        if ($this->request->isPost()) {

            $projectTable = new TableGateway('beneficiary_profile_disabled', $this->dbAdapter);

            if ($this->request->getPost("pAction") == "DELETE") {
                $iMasterID = $this->request->getPost("KEY_ID");
				
				$projectTable->delete(array("id=".$iMasterID));
                $result['DBStatus'] = 'OK';
                $result = json_encode($result);
                echo $result;
                exit;
            }
        }
    }
	
	
	/********* MEDICAL CONDITION STEP **********/
	public function listMedicalConditionAction()
	{
		$activeLocalesArray = $this->AdminfunctionsPlugin()->getActiveLocales($this->dbAdapter);
		$aColumns = array( '`id`','`beneficiary_name`','`current_medical_condition`','`medical_history`','`surgical_history`','`family_history`','`treatment_history`');
			
		$sTable = 'view_beneficiary_profile_medical';
	
		/* Indexed column (used for fast and accurate table cardinality) */
		$sIndexColumn = "id";  
		
		$sWhere = " WHERE beneficiary_id = '".$this->request->getPost("beneficiaryID")."' ";
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
		exit;
	}	
	public function saveMedicalConditionAction()
	{  
		$activeLocalesArray = $this->AdminfunctionsPlugin()->getActiveLocales($this->dbAdapter);       
		$tableName = 'beneficiary_profile_medical';
		$tableNameLocale = 'beneficiary_profile_medical_locale';
        if ($this->request->isPost()) {

			if ($this->request->getPost("beneficiaryID") > 0)
			{
				$beneficiaryID = $this->request->getPost("beneficiaryID");
				$projectTable = new TableGateway($tableName,$this->dbAdapter);
				$projectTableLocale = new TableGateway($tableNameLocale,$this->dbAdapter);
				
				$aData = json_decode($this->request->getPost("FORM_DATA"));
				$aData = (array)$aData;	
				
				$masterData = array();
				$masterData['beneficiary_profile_family_id'] 					= $aData['beneficiary_profile_family_id'];
				$masterData['beneficiary_id'] 									= $beneficiaryID;
	
				if ($this->request->getPost("pAction") == "ADD")
				{					
					$masterData['owner_organization_id'] = self::$Aula_OwnerOrgID;
					$masterData['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;
					$masterData['date_added'] = date('Y-m-d H:i:s');
					
					$projectTable->insert($masterData);	
					$iMasterID = $projectTable->lastInsertValue;
					$result['DBStatus'] = 'OK';					
				}
				else  if($this->request->getPost("pAction") == "EDIT")
				{			
					$iMasterID=$aData['MASTER_KEY_ID'];	
					$masterData['date_updated'] = date('Y-m-d H:i:s');
					
					$projectTable->update($masterData,array("id=".$iMasterID));
																		
					$result['DBStatus'] = 'OK';
				}
				foreach($activeLocalesArray as $locale)
				{
					$detailData = array();
					$detailData['current_medical_condition'] = $aData['current_medical_condition_'.$locale['id']];
					$detailData['medical_history'] = $aData['medical_history_'.$locale['id']];
					$detailData['surgical_history'] = $aData['surgical_history_'.$locale['id']];
					$detailData['family_history'] = $aData['family_history_'.$locale['id']];
					$detailData['treatment_history'] = $aData['treatment_history_'.$locale['id']];
					$detailData['lab_results_history'] = $aData['lab_results_history_'.$locale['id']];
					$detailData['prescription_history'] = $aData['prescription_history_'.$locale['id']];
					$detailData['beneficiary_profile_family_id'] = $aData['beneficiary_profile_family_id'];
					
					$rowset = $projectTableLocale->select([ "beneficiary_profile_medical_id" => $iMasterID, "locale_id" => $locale['id'] ]);
					$rowset = $rowset->toArray();
					if($rowset[0]['id'] > 0)
					{
						$detailData['date_updated'] = date('Y-m-d H:i:s');						
						$projectTableLocale->update($detailData,['id' => $rowset[0]['id'] ]);
					}
					else
					{							
						$detailData['locale_id'] = $locale['id'];
						$detailData['beneficiary_id'] = $beneficiaryID;
						$detailData['beneficiary_profile_medical_id'] = $iMasterID;
						$detailData['date_added'] = date('Y-m-d H:i:s');
						
						$detailData['owner_organization_id'] = self::$Aula_OwnerOrgID;
						$detailData['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;
					
						$projectTableLocale->insert($detailData);	
					}
					
				}
			}
			else
			{
				$result['DBStatus'] = 'ERR';
			}
		}
        else
        {
            $result['DBStatus'] = 'ERR';
        }

        $result = json_encode($result);
        echo $result;
        exit;
    
	}	
	public function getrecMedicalConditionAction()
    {
        $activeLocalesArray = $this->AdminfunctionsPlugin()->getActiveLocales($this->dbAdapter);       
		$recs=array();
        if ($this->request->isPost()) {
            
			$iID = $this->request->getPost("KEY_ID");
			
			$projectTable = new TableGateway('beneficiary_profile_medical', $this->dbAdapter);
			$rowset = $projectTable->select(array('id' => $iID));
			$rowset = $rowset->toArray();			

            foreach ($rowset as $record)
			{
             	foreach($activeLocalesArray as $locale)
				{
					$sQuery_locale 		= "SELECT * FROM beneficiary_profile_medical_locale WHERE locale_id = '".$locale['id']."' AND  	 	beneficiary_profile_medical_id = '".$record['id']."' ";
					$statement_locale	= $this->dbAdapter->createStatement($sQuery_locale, $optionalParameters);        
					$resultData_locale	= $statement_locale->execute();        
					$resultSet_locale	= new ResultSet; 			   
					$resultSet_locale->initialize($resultData_locale);        
					$rowset_locale		= $resultSet_locale->toArray();
					
					$record['current_medical_condition_'.$locale['id']] = $rowset_locale[0]['current_medical_condition'];
					$record['medical_history_'.$locale['id']] = $rowset_locale[0]['medical_history'];
					$record['surgical_history_'.$locale['id']] = $rowset_locale[0]['surgical_history'];
					$record['family_history_'.$locale['id']] = $rowset_locale[0]['family_history'];
					$record['treatment_history_'.$locale['id']] = $rowset_locale[0]['treatment_history'];
					$record['lab_results_history_'.$locale['id']] = $rowset_locale[0]['lab_results_history'];
					$record['prescription_history_'.$locale['id']] = $rowset_locale[0]['prescription_history'];
				}				
			    $recs[] = $record;
			}
            $result['data'] = $recs;
            $result['recordsTotal'] = count($recs);
            $result['DBStatus'] = 'OK';

            $result = json_encode($result);
            echo $result;
            exit;
        }
    }		
	public function deleteMedicalConditionAction()
    {        
        if ($this->request->isPost()) {

            $projectTable = new TableGateway('beneficiary_profile_medical', $this->dbAdapter);
			$projectTableLocale = new TableGateway('beneficiary_profile_medical_locale', $this->dbAdapter);

            if ($this->request->getPost("pAction") == "DELETE") {
                $iMasterID = $this->request->getPost("KEY_ID");
				
				$projectTable->delete(array("id=".$iMasterID));
				$projectTableLocale->delete(array("beneficiary_profile_medical_id=".$iMasterID));
                $result['DBStatus'] = 'OK';
                $result = json_encode($result);
                echo $result;
                exit;
            }
        }
    }
	
	/********* MEDICAL EXAMINATION STEP **********/
	public function listMedicalExtraDetailAction()
	{
		$activeLocalesArray = $this->AdminfunctionsPlugin()->getActiveLocales($this->dbAdapter);
		$aColumns = array( '`id`','`doctor_name`','`doctor_mobile_number`','`complaint`','`examination`','`treatment`');
			
		$sTable = 'view_beneficiary_profile_medical_examination';
	
		/* Indexed column (used for fast and accurate table cardinality) */
		$sIndexColumn = "id";  
		
		$sWhere = " WHERE beneficiary_id = '".$this->request->getPost("beneficiaryID")."' ";
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
		exit;
	}	
	public function saveMedicalExtraDetailAction()
	{  
		$activeLocalesArray = $this->AdminfunctionsPlugin()->getActiveLocales($this->dbAdapter);       
		$tableName = 'beneficiary_profile_medical_examination';
		$tableNameLocale = 'beneficiary_profile_medical_examination_locale';
        if ($this->request->isPost()) {

			if ($this->request->getPost("beneficiaryID") > 0)
			{
				$beneficiaryID = $this->request->getPost("beneficiaryID");
				$projectTable = new TableGateway($tableName,$this->dbAdapter);
				$projectTableLocale = new TableGateway($tableNameLocale,$this->dbAdapter);
				
				$aData = json_decode($this->request->getPost("FORM_DATA"));
				$aData = (array)$aData;	
				
				$masterData = array();
				$masterData['doctor_mobile_number'] 							= $aData['doctor_mobile_number'];
				$masterData['doctor_phone_number'] 								= $aData['doctor_phone_number'];
				$masterData['beneficiary_profile_family_id'] 					= $aData['beneficiary_profile_family_id'];
				$masterData['beneficiary_id'] 									= $beneficiaryID;
	
				if ($this->request->getPost("pAction") == "ADD")
				{					
					$masterData['owner_organization_id'] = self::$Aula_OwnerOrgID;
					$masterData['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;
					$masterData['date_added'] = date('Y-m-d H:i:s');
					
					$projectTable->insert($masterData);	
					$iMasterID = $projectTable->lastInsertValue;
					$result['DBStatus'] = 'OK';					
				}
				else  if($this->request->getPost("pAction") == "EDIT")
				{			
					$iMasterID=$aData['MASTER_KEY_ID'];	
					$masterData['date_updated'] = date('Y-m-d H:i:s');
					
					$projectTable->update($masterData,array("id=".$iMasterID));
																		
					$result['DBStatus'] = 'OK';
				}
				foreach($activeLocalesArray as $locale)
				{
					$detailData = array();
					$detailData['doctor_name'] = $aData['doctor_name_'.$locale['id']];
					$detailData['doctor_address'] = $aData['doctor_address_'.$locale['id']];
					$detailData['complaint'] = $aData['complaint_'.$locale['id']];
					$detailData['examination'] = $aData['examination_'.$locale['id']];
					$detailData['treatment'] = $aData['treatment_'.$locale['id']];
					$detailData['lab_results'] = $aData['lab_results_'.$locale['id']];
					$detailData['prescription'] = $aData['prescription_'.$locale['id']];
					$detailData['procedure'] = $aData['procedure_'.$locale['id']];
					$detailData['comment'] = $aData['comment_'.$locale['id']];
					$detailData['beneficiary_profile_family_id'] = $aData['beneficiary_profile_family_id'];
					
					$rowset = $projectTableLocale->select([ "beneficiary_profile_medical_examination_id" => $iMasterID, "locale_id" => $locale['id'] ]);
					$rowset = $rowset->toArray();
					if($rowset[0]['id'] > 0)
					{
						$detailData['date_updated'] = date('Y-m-d H:i:s');						
						$projectTableLocale->update($detailData,['id' => $rowset[0]['id'] ]);
					}
					else
					{							
						$detailData['locale_id'] = $locale['id'];
						$detailData['beneficiary_id'] = $beneficiaryID;
						$detailData['beneficiary_profile_medical_examination_id'] = $iMasterID;
						$detailData['date_added'] = date('Y-m-d H:i:s');
						
						$detailData['owner_organization_id'] = self::$Aula_OwnerOrgID;
						$detailData['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;
					
						$projectTableLocale->insert($detailData);	
					}
					
				}
			}
			else
			{
				$result['DBStatus'] = 'ERR';
			}
		}
        else
        {
            $result['DBStatus'] = 'ERR';
        }

        $result = json_encode($result);
        echo $result;
        exit;
    
	}	
	public function getrecMedicalExtraDetailAction()
    {
        $activeLocalesArray = $this->AdminfunctionsPlugin()->getActiveLocales($this->dbAdapter);       
		$recs=array();
        if ($this->request->isPost()) {
            
			$iID = $this->request->getPost("KEY_ID");
			
			$projectTable = new TableGateway('beneficiary_profile_medical_examination', $this->dbAdapter);
			$rowset = $projectTable->select(array('id' => $iID));
			$rowset = $rowset->toArray();			

            foreach ($rowset as $record)
			{
             	foreach($activeLocalesArray as $locale)
				{
					$sQuery_locale 		= "SELECT * FROM beneficiary_profile_medical_examination_locale WHERE locale_id = '".$locale['id']."' AND  	 	beneficiary_profile_medical_examination_id = '".$record['id']."' ";
					$statement_locale	= $this->dbAdapter->createStatement($sQuery_locale, $optionalParameters);        
					$resultData_locale	= $statement_locale->execute();        
					$resultSet_locale	= new ResultSet; 			   
					$resultSet_locale->initialize($resultData_locale);        
					$rowset_locale		= $resultSet_locale->toArray();
					
					$record['doctor_name_'.$locale['id']] = $rowset_locale[0]['doctor_name'];
					$record['doctor_address_'.$locale['id']] = $rowset_locale[0]['doctor_address'];
					$record['complaint_'.$locale['id']] = $rowset_locale[0]['complaint'];
					$record['examination_'.$locale['id']] = $rowset_locale[0]['examination'];
					$record['treatment_'.$locale['id']] = $rowset_locale[0]['treatment'];
					$record['lab_results_'.$locale['id']] = $rowset_locale[0]['lab_results'];
					$record['prescription_'.$locale['id']] = $rowset_locale[0]['prescription'];
					$record['procedure_'.$locale['id']] = $rowset_locale[0]['procedure'];
					$record['comment_'.$locale['id']] = $rowset_locale[0]['comment'];
				}				
			    $recs[] = $record;
			}
            $result['data'] = $recs;
            $result['recordsTotal'] = count($recs);
            $result['DBStatus'] = 'OK';

            $result = json_encode($result);
            echo $result;
            exit;
        }
    }		
	public function deleteMedicalExtraDetailAction()
    {        
        if ($this->request->isPost()) {

            $projectTable = new TableGateway('beneficiary_profile_medical_examination', $this->dbAdapter);
			$projectTableLocale = new TableGateway('beneficiary_profile_medical_examination_locale', $this->dbAdapter);

            if ($this->request->getPost("pAction") == "DELETE") {
                $iMasterID = $this->request->getPost("KEY_ID");
				
				$projectTable->delete(array("id=".$iMasterID));
				$projectTableLocale->delete(array("beneficiary_profile_medical_examination_id=".$iMasterID));
                $result['DBStatus'] = 'OK';
                $result = json_encode($result);
                echo $result;
                exit;
            }
        }
    }
	
	
	/********* EDUCATION DETAIL STEP **********/
	public function listEducationDetailAction()
	{
		$activeLocalesArray = $this->AdminfunctionsPlugin()->getActiveLocales($this->dbAdapter);
		$aColumns = array( '`id`','`beneficiary_name`','`school_type`','`start_at`','`end_at`','`institute_name`','`final_grade`');
			
		$sTable = 'view_beneficiary_profile_education_level ';
	
		/* Indexed column (used for fast and accurate table cardinality) */
		$sIndexColumn = "id";  
		
		$sWhere = " WHERE beneficiary_id = '".$this->request->getPost("beneficiaryID")."' ";
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
					case 'start_at' :
						$start_at_ar = explode("-",$aRow['start_at']);
						$row[] = $start_at_ar[1].'/'.$start_at_ar[2].'/'.$start_at_ar[0];
						break;
					case 'end_at' :
						$end_at_ar = explode("-",$aRow['end_at']);
						$row[] = $end_at_ar[1].'/'.$end_at_ar[2].'/'.$end_at_ar[0];
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
		exit;
	}	
	public function saveEducationDetailAction()
	{  
		$activeLocalesArray = $this->AdminfunctionsPlugin()->getActiveLocales($this->dbAdapter);       
		$tableName = 'beneficiary_profile_education_level';
		$tableNameLocale = 'beneficiary_profile_education_level_locale';
        if ($this->request->isPost()) {

			if ($this->request->getPost("beneficiaryID") > 0)
			{
				$beneficiaryID = $this->request->getPost("beneficiaryID");
				$projectTable = new TableGateway($tableName,$this->dbAdapter);
				$projectTableLocale = new TableGateway($tableNameLocale,$this->dbAdapter);
				
				$aData = json_decode($this->request->getPost("FORM_DATA"));
				$aData = (array)$aData;	
				
				if($aData['start_at'] != '') {
					$start_at_ar = explode("/",$aData['start_at']);
					$start_at = $start_at_ar[2].'-'.$start_at_ar[0].'-'.$start_at_ar[1];
					$aData['start_at'] = $start_at;
				}
				else {
					unset($aData['start_at']);
				}
				
				if($aData['end_at'] != '') {
					$end_at_ar = explode("/",$aData['end_at']);
					$end_at = $end_at_ar[2].'-'.$end_at_ar[0].'-'.$end_at_ar[1];
					$aData['end_at'] = $end_at;
				}
				else {
					unset($aData['end_at']);
				}
				
				$masterData = array();
				$masterData['school_type'] 										= $aData['school_type'];
				$masterData['start_at'] 										= $aData['start_at'];
				$masterData['end_at'] 											= $aData['end_at'];
				$masterData['beneficiary_profile_family_id'] 					= $aData['beneficiary_profile_family_id'];
				$masterData['beneficiary_id'] 									= $beneficiaryID;
	
				if ($this->request->getPost("pAction") == "ADD")
				{					
					$masterData['owner_organization_id'] = self::$Aula_OwnerOrgID;
					$masterData['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;
					$masterData['date_added'] = date('Y-m-d H:i:s');
					
					$projectTable->insert($masterData);	
					$iMasterID = $projectTable->lastInsertValue;
					$result['DBStatus'] = 'OK';					
				}
				else  if($this->request->getPost("pAction") == "EDIT")
				{			
					$iMasterID=$aData['MASTER_KEY_ID'];	
					$masterData['date_updated'] = date('Y-m-d H:i:s');
					
					$projectTable->update($masterData,array("id=".$iMasterID));
																		
					$result['DBStatus'] = 'OK';
				}
				foreach($activeLocalesArray as $locale)
				{
					$detailData = array();
					$detailData['institute_name'] = $aData['institute_name_'.$locale['id']];
					$detailData['school_name'] = $aData['school_name_'.$locale['id']];
					$detailData['level_name'] = $aData['level_name_'.$locale['id']];
					$detailData['major_name'] = $aData['major_name_'.$locale['id']];
					$detailData['class_name'] = $aData['class_name_'.$locale['id']];
					$detailData['address'] = $aData['address_'.$locale['id']];
					$detailData['final_grade'] = $aData['final_grade_'.$locale['id']];
					
					$rowset = $projectTableLocale->select([ "beneficiary_profile_education_level_id" => $iMasterID, "locale_id" => $locale['id'] ]);
					$rowset = $rowset->toArray();
					if($rowset[0]['id'] > 0)
					{
						$detailData['date_updated'] = date('Y-m-d H:i:s');						
						$projectTableLocale->update($detailData,['id' => $rowset[0]['id'] ]);
					}
					else
					{							
						$detailData['locale_id'] = $locale['id'];
						$detailData['beneficiary_id'] = $beneficiaryID;
						$detailData['beneficiary_profile_education_level_id'] = $iMasterID;
						$detailData['date_added'] = date('Y-m-d H:i:s');
						
						$detailData['owner_organization_id'] = self::$Aula_OwnerOrgID;
						$detailData['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;
					
						$projectTableLocale->insert($detailData);	
					}
					
				}
			}
			else
			{
				$result['DBStatus'] = 'ERR';
			}
		}
        else
        {
            $result['DBStatus'] = 'ERR';
        }

        $result = json_encode($result);
        echo $result;
        exit;
    
	}	
	public function getrecEducationDetailAction()
    {
        $activeLocalesArray = $this->AdminfunctionsPlugin()->getActiveLocales($this->dbAdapter);       
		$recs=array();
        if ($this->request->isPost()) {
            
			$iID = $this->request->getPost("KEY_ID");
			
			$projectTable = new TableGateway('beneficiary_profile_education_level', $this->dbAdapter);
			$rowset = $projectTable->select(array('id' => $iID));
			$rowset = $rowset->toArray();			

            foreach ($rowset as $record)
			{
             	foreach($activeLocalesArray as $locale)
				{
					$sQuery_locale 		= "SELECT * FROM beneficiary_profile_education_level_locale WHERE locale_id = '".$locale['id']."' AND beneficiary_profile_education_level_id = '".$record['id']."' ";
					$statement_locale	= $this->dbAdapter->createStatement($sQuery_locale, $optionalParameters);        
					$resultData_locale	= $statement_locale->execute();        
					$resultSet_locale	= new ResultSet; 			   
					$resultSet_locale->initialize($resultData_locale);        
					$rowset_locale		= $resultSet_locale->toArray();
					
					$record['institute_name_'.$locale['id']] = $rowset_locale[0]['institute_name'];
					$record['school_name_'.$locale['id']] = $rowset_locale[0]['school_name'];
					$record['level_name_'.$locale['id']] = $rowset_locale[0]['level_name'];
					$record['major_name_'.$locale['id']] = $rowset_locale[0]['major_name'];
					$record['class_name_'.$locale['id']] = $rowset_locale[0]['class_name'];
					$record['address_'.$locale['id']] = $rowset_locale[0]['address'];
					$record['final_grade_'.$locale['id']] = $rowset_locale[0]['final_grade'];
				}	
				$start_at_ar = explode("-",$record['start_at']);
				$record['start_at'] = $start_at_ar[1].'/'.$start_at_ar[2].'/'.$start_at_ar[0];				
				
				$end_at_ar = explode("-",$record['end_at']);
				$record['end_at'] = $end_at_ar[1].'/'.$end_at_ar[2].'/'.$end_at_ar[0];			
			    $recs[] = $record;
			}
            $result['data'] = $recs;
            $result['recordsTotal'] = count($recs);
            $result['DBStatus'] = 'OK';

            $result = json_encode($result);
            echo $result;
            exit;
        }
    }		
	public function deleteEducationDetailAction()
    {        
        if ($this->request->isPost()) {

            $projectTable = new TableGateway('beneficiary_profile_education_level', $this->dbAdapter);
			$projectTableLocale = new TableGateway('beneficiary_profile_education_level_locale', $this->dbAdapter);

            if ($this->request->getPost("pAction") == "DELETE") {
                $iMasterID = $this->request->getPost("KEY_ID");
				
				$projectTable->delete(array("id=".$iMasterID));
				$projectTableLocale->delete(array("beneficiary_profile_education_level_id=".$iMasterID));
                $result['DBStatus'] = 'OK';
                $result = json_encode($result);
                echo $result;
                exit;
            }
        }
    }
	
	/********* VOLUNTEER (LAY READER) DETAIL STEP **********/	
	public function saveLayReaderDetailAction()
	{    
		$activeLocalesArray = $this->AdminfunctionsPlugin()->getActiveLocales($this->dbAdapter);       
		$tableName = 'beneficiary_profile_volunteer';
		$tableNameLocale = 'beneficiary_profile_volunteer_locale';
		$tableNameActivity = 'beneficiary_profile_volunteer_activity';
		$tableNameLocaleActivity = 'beneficiary_profile_volunteer_activity_locale';
        if ($this->request->isPost()) {

			if ($this->request->getPost("beneficiaryID") > 0)
			{
				$beneficiaryID = $this->request->getPost("beneficiaryID");
				$projectTable = new TableGateway($tableName,$this->dbAdapter);
				$projectTableLocale = new TableGateway($tableNameLocale,$this->dbAdapter);
				$projectTableActivity = new TableGateway($tableNameActivity,$this->dbAdapter);
				$projectTableLocaleActivity = new TableGateway($tableNameLocaleActivity,$this->dbAdapter);
				
				$aData = json_decode($this->request->getPost("FORM_DATA"));
				$aData = (array)$aData;			
				
				$masterData = array();
				$masterData['volunteer_type_id'] = $aData['volunteer_type_id'];
				
				
				$rowset = $projectTable->select(['beneficiary_id' => $beneficiaryID]);
				$rowset = $rowset->toArray();
				if($rowset[0]['id'] > 0)
				{
					$masterData['date_updated'] = date('Y-m-d H:i:s');
					$projectTable->update($masterData,['id' => $rowset[0]['id']]);
					$iMasterID = $rowset[0]['id'];
				}
				else
				{
					$masterData['beneficiary_id'] = $beneficiaryID;
					$masterData['date_added'] = date('Y-m-d H:i:s');
					
					$masterData['owner_organization_id'] = self::$Aula_OwnerOrgID;
					$masterData['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;
					$projectTable->insert($masterData);
					$iMasterID = $projectTable->lastInsertValue;
				}
				foreach($activeLocalesArray as $locale)
				{
					$detailData = array();
					$detailData['details'] = $aData['details_'.$locale['id']];
					$detailData['address'] = $aData['address_'.$locale['id']];
					
					$rowset = $projectTableLocale->select([ "beneficiary_profile_volunteer_id" => $iMasterID, "locale_id" => $locale['id'] ]);
					$rowset = $rowset->toArray();
					if($rowset[0]['id'] > 0)
					{
						$detailData['date_updated'] = date('Y-m-d H:i:s');						
						$projectTableLocale->update($detailData,['id' => $rowset[0]['id'] ]);
					}
					else
					{							
						$detailData['locale_id'] = $locale['id'];
						$detailData['beneficiary_id'] = $beneficiaryID;
						$detailData['beneficiary_profile_volunteer_id'] = $iMasterID;
						$detailData['date_added'] = date('Y-m-d H:i:s');
						
						$detailData['owner_organization_id'] = self::$Aula_OwnerOrgID;
						$detailData['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;
					
						$projectTableLocale->insert($detailData);	
					}
				}	
				
				if($aData['name_'.$this->config['global_locale_id']] != '' || $aData['description_'.$this->config['global_locale_id']] != '')
				{
					$masterData = array();						
					
					$rowset = $projectTableActivity->select(['beneficiary_id' => $beneficiaryID]);
					$rowset = $rowset->toArray();
					if($rowset[0]['id'] > 0)
					{
						$masterData['date_updated'] = date('Y-m-d H:i:s');
						$projectTableActivity->update($masterData,['id' => $rowset[0]['id']]);
						$iMasterIDActivity = $rowset[0]['id'];
					}
					else
					{
						$masterData['beneficiary_id'] = $beneficiaryID;
						$masterData['beneficiary_profile_volunteer_id'] = $iMasterID;
						$masterData['date_added'] = date('Y-m-d H:i:s');
						
						$masterData['owner_organization_id'] = self::$Aula_OwnerOrgID;
						$masterData['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;
						$projectTableActivity->insert($masterData);
						$iMasterIDActivity = $projectTableActivity->lastInsertValue;
					}
					foreach($activeLocalesArray as $locale)
					{
						$detailData = array();
						$detailData['name'] = $aData['name_'.$locale['id']];
						$detailData['description'] = $aData['description_'.$locale['id']];
						
						$rowset = $projectTableLocaleActivity->select([ "beneficiary_profile_volunteer_activity_id" => $iMasterID, "locale_id" => $locale['id'] ]);
						$rowset = $rowset->toArray();
						if($rowset[0]['id'] > 0)
						{
							$detailData['date_updated'] = date('Y-m-d H:i:s');						
							$projectTableLocaleActivity->update($detailData,['id' => $rowset[0]['id'] ]);
						}
						else
						{							
							$detailData['locale_id'] = $locale['id'];
							$detailData['beneficiary_id'] = $beneficiaryID;
							$detailData['beneficiary_profile_volunteer_activity_id'] = $iMasterIDActivity;
							$detailData['beneficiary_profile_volunteer_id'] = $iMasterID;
							$detailData['date_added'] = date('Y-m-d H:i:s');
							
							$detailData['owner_organization_id'] = self::$Aula_OwnerOrgID;
							$detailData['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;
						
							$projectTableLocaleActivity->insert($detailData);	
						}
					}
				}			
							
				$result['DBStatus'] = 'OK';
			}
			else
			{
				 $result['DBStatus'] = 'ERR';
			}
		}
        else
        {
            $result['DBStatus'] = 'ERR';
        }

        $result = json_encode($result);
        echo $result;
        exit;
	}
	public function savedonationAction()
    {
		$result1['DBStatus'] = 'OK';
		$result = json_encode($result1);
        echo $result;
        exit;
	}
	public function getgriddetailslistAction()
	{
		
		$iID = $this->request->getPost("KEY_ID");
		$beneficiary_profile = $this->AdminfunctionsPlugin()->getSingleRecord2('id',$iID,'view_beneficiary_profile',$this->dbAdapter);
			$grid_list = '';
			$grid_list .= '<h5 class="gridDetailSectionHeading">Beneficiary Profile:</h5>';
			$grid_list .= '<table cellpadding="5" cellspacing="0" border="0" class="table table-hover table-condensed gridDetailTable" id="menu_category_detail_tbl"><tr><td>Profile</td><td>Status</td></tr>';
			$profile=array('details'=>'Basic Details','family'=>'Family Details','family_flag'=>'Family Extra Details','income'=>'Income Details','spending'=>'Spending Details','home'=>'Home Details','asset'=>'All Owned Assets','asset_required'=>'All Required Assets','disabled'=>'Disabled Details','medical'=>'Medical Conditions','medical_examination'=>'Medical Extra Details','education'=>'Education Details','volunteer'=>'Lay Reader Details','gallery'=>'Media Gallery','research_notes'=>'Researcher Notes');
			
			if(count($beneficiary_profile) > 0)
			{	
				foreach($beneficiary_profile[0] as $beneficiarykey => $beneficiarydata)
				{
					if($beneficiarydata=="Yes")
					{
							$grid_list .= '<tr >
											<td>'.$profile[$beneficiarykey].'</td>
											<td>-</td>
										</tr>';
						
					}						
				}
			}
			else
			{
				$grid_list .= '<tr >
									<td class="datafound">No Data Found</td>
							</tr>';
			}	
			$grid_list .= '</table>';
			
			
			$family_flag = $this->AdminfunctionsPlugin()->getSingleRecord2('beneficiary_id',$iID,'view_beneficiary_profile_family_has_flag',$this->dbAdapter);
			$grid_list .= '<h5 class="gridDetailSectionHeading">Beneficiary flags:</h5>';
			$grid_list .= '<table cellpadding="5" cellspacing="0" border="0" class="table table-hover table-condensed " id="menu_category_detail_tbl"><tr class="gridDetailSectionHeading"><td>Flag Name</td><td>Profile Family</td><td>Flag Value</td></tr>';
			
			
			if(count($family_flag) > 0)
			{	
				foreach($family_flag as $family_flagdata)
				{
					
							$grid_list .= '<tr >
											<td>'.$family_flagdata['flag_name'].'</td>
						
											<td>'.$family_flagdata['profile_family_name'].'</td>
							
											<td>'.$family_flagdata['flag_value'].'</td>
										</tr>';						
						
											
				}
			}
			else
			{
				$grid_list .= '<tr >
									<td class="datafound" colspan="3">No Data Found</td>
							</tr>';
			}	
			$grid_list .= '</table>';
			
		/** Output **/
		$output = array(
			"status" => 'OK',
			"grid_list" => $grid_list
		);
		echo json_encode( $output ); 
		die();
	
	}
	public function savesponsorshipAction()
    {
		$result1['DBStatus'] = 'OK';
		$result = json_encode($result1);
        echo $result;
        exit;
	}
	public function savemanagegroupsAction()
    {					
		$result1['DBStatus'] = 'OK';
		$result = json_encode($result1);
        echo $result;
        exit;
	}


}