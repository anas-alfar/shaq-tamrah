<?php
namespace Aula_Adminpanel\Controller;

use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Db\Sql\Sql as Sql;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Adapter\AdapterInterface;

class GalleryController extends AbstractActionController
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
		$aColumns = array( '`id`','`path`','`alias`','`beneficiary`','`beneficiary_profile_family`','`mime_type`','`media_status`','`published`');
		if(!($this->memCached->hasItem('aula_gallery_data')) || !is_array($this->memCached->getItem('aula_gallery_data')))
		{	
			$sTable = 'view_beneficiary_media_gallery';
		
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
					$sQuery_locale 		= "SELECT alias,intro_text FROM beneficiary_media_gallery_locale WHERE locale_id = '".$locale['id']."' AND beneficiary_media_gallery_id = '".$aRow['id']."' ";
					$statement_locale	= $this->dbAdapter->createStatement($sQuery_locale, $optionalParameters);        
					$resultData_locale	= $statement_locale->execute();        
					$resultSet_locale	= new ResultSet; 			   
					$resultSet_locale->initialize($resultData_locale);        
					$rowset_locale		= $resultSet_locale->toArray();
					$aRow['alias_'.$locale['id']] = $rowset_locale[0]['alias'];
					$aRow['intro_text_'.$locale['id']] = $rowset_locale[0]['intro_text'];
				}
				$rowsetCache[$aRow['id']] = $aRow;
			}
			$this->memCached->setItem('aula_gallery_data',$rowsetCache);
		}
			
		$rowset = $this->memCached->getItem('aula_gallery_data');
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
	public function uploadlogoAction()
    {
        $aData = (array)$aData;
		
        if ($this->request->isPost()) {

            $file = $_FILES['media'];
            $filename = $_FILES['media']['name'];
			$filename = rand(0,999).$filename;
			$myImagePath =  $this->config['site_dir_path']['public_dir_path']."uploads/localeicons/".$filename;
			$size=$_FILES['media']['size'];
            if (!move_uploaded_file($file['tmp_name'], $myImagePath)) {
                $result['status'] = 'ERR';
                $result['message1'] = 'Unable to save file![signature]';
            } else {
                $result['status'] = 'OK';
                $result['message1'] = 'Done';				
				$result['media'] = $filename;

            }
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
			$sql = "SELECT * FROM view_beneficiary_media_gallery WHERE 1 = 1";
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
			$csvData .= "#ID,Media File,Media Type,Media File Type,Media Status,Beneficiary,Beneficiary Profile Family,Published(Yes|No),";
			foreach($activeLocalesArray as $locale)
			{
				$csvData .= "Alias(".$locale['name']."),";
				$csvData .= "Intro Text(".$locale['name']."),";
				
			}
			$csvData .= "\n";
				
			
			foreach($rowset as $row)
			{
				
				$csvData .= $row['id'].",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['path']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['media_type']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['media_filetype']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['media_status']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['beneficiary']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['beneficiary_profile_family']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['published']).",";
				foreach($activeLocalesArray as $locale)
					{
						$sQuery_locale1 		= "SELECT alias,intro_text FROM beneficiary_media_gallery_locale WHERE locale_id = '".$locale['id']."' AND beneficiary_media_gallery_id = '".$row['id']."' ";
						$statement_locale	= $this->dbAdapter->createStatement($sQuery_locale1, $optionalParameters);        
						$resultData_locale	= $statement_locale->execute();        
						$resultSet_locale	= new ResultSet; 			   
						$resultSet_locale->initialize($resultData_locale);        
						$rowset_locale		= $resultSet_locale->toArray();
						$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($rowset_locale[0]['alias']).",";
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
        $projectTable = new TableGateway('beneficiary_media_gallery',$this->dbAdapter);
		$projectTableLocale = new TableGateway('beneficiary_media_gallery_locale',$this->dbAdapter);
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
							if($data[1] != "" && $data[2] != "" && $data[3] != "" && $data[4] != "" && $data[5] != "" && $data[6] != ""&& $data[7] != ""&& $data[8] != ""&& $data[9] != "" )
							{
							
								$saveDataArray = array();
								$column_index = 1;
								$saveDataArray['path'] 	= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								
							 	$getMediaTypeID1 = $this->AdminfunctionsPlugin()->validateduplicateLocaleCSV('media_type_locale',$this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]),'name','media_type_id',$this->dbAdapter,$this->config['global_locale_id'],'locale_id');
								$saveDataArray['media_type_id']= $getMediaTypeID1;	
								
								$getMediaFileTypeID1 = $this->AdminfunctionsPlugin()->validateduplicateLocaleCSV('media_filetype_locale',$this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]),'name','media_filetype_id',$this->dbAdapter,$this->config['global_locale_id'],'locale_id');
								$saveDataArray['media_filetype_id']= $getMediaFileTypeID1;
								
						
								$getMediaStatusID1 = $this->AdminfunctionsPlugin()->validateduplicateLocaleCSV('media_status_locale',$this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]),'name','media_status_id',$this->dbAdapter,$this->config['global_locale_id'],'locale_id');
								$saveDataArray['media_status_id']= $getMediaStatusID1;
								
								
								$getBeneficiaryID1 = $this->AdminfunctionsPlugin()->validateduplicateLocaleCSV('beneficiary_locale',$this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]),'family_name','beneficiary_id',$this->dbAdapter,$this->config['global_locale_id'],'locale_id');
								$saveDataArray['beneficiary_id']= $getBeneficiaryID1;
								
								if(!($saveDataArray['beneficiary_id'] > 0))
								{
									continue;
								}
								
								$getProfileFamilyID1 = $this->AdminfunctionsPlugin()->validateduplicateLocaleCSV('beneficiary_profile_family_locale',$this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]),'first_name','beneficiary_profile_family_id',$this->dbAdapter,$this->config['global_locale_id'],'locale_id');
								$saveDataArray['beneficiary_profile_family_id']= $getProfileFamilyID1;
								if(!($saveDataArray['beneficiary_profile_family_id'] > 0))
								{
									continue;
								}
								
								$saveDataArray['published'] 	= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$detailData = array();
								$detailData['alias'] = $data[$column_index++];
								$detailData['intro_text'] = $data[$column_index++];
								
								/*$existRecordID = $this->AdminfunctionsPlugin()->validateduplicateCSV('view_beneficiary_media_gallery',$detailData['alias'],'alias',$this->dbAdapter,$data[0]);	
								if($existRecordID > 0)
								{
									continue;
								}*/
								$existRecordID = $data[0]; 
								$info=mime_content_type($this->config['site_dir_path']['public_dir_path']."uploads/localeicons/".$saveDataArray['path']);
								$size = filesize($this->config['site_dir_path']['public_dir_path']."uploads/localeicons/".$saveDataArray['path']);
								if($existRecordID > 0)
								{
									$saveDataArray['size'] = $size;	
									$saveDataArray['mime_type'] = $info;
									$saveDataArray['date_updated'] = date('Y-m-d H:i:s');		
									$projectTable->update($saveDataArray,array("id=".$existRecordID));
									
									$detailData['date_updated'] = date('Y-m-d H:i:s');
									$projectTableLocale->update($detailData,array("beneficiary_media_gallery_id=".$existRecordID,"locale_id=".$this->config['global_locale_id']));	
								}
								else
								{
									$sql="select sequence from beneficiary_media_gallery order by sequence DESC LIMIT 1 ";
				
									$optionalParameters	= array();        
									$statement 			= $this->dbAdapter->createStatement($sql, $optionalParameters);        
									$resultData			= $statement->execute();        
									$resultSet 			= new ResultSet; 			   
									$resultSet->initialize($resultData);        
									$rowset 			= $resultSet->toArray();
									
									
									$saveDataArray['owner_organization_id'] = self::$Aula_OwnerOrgID;
									$saveDataArray['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;	
									$saveDataArray['sequence'] = $rowset[0]['sequence']+1;	
									$saveDataArray['size'] = $size;	
									$saveDataArray['mime_type'] = $info;		
									$projectTable->insert($saveDataArray);	
									$existRecordID = $projectTable->lastInsertValue;	
									
									$detailData['owner_organization_id'] = self::$Aula_OwnerOrgID;
									$detailData['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;	
									$detailData['beneficiary_media_gallery_id'] = $existRecordID;
									$detailData['beneficiary_id']= $getBeneficiaryID1;
									$detailData['locale_id'] = $this->config['global_locale_id'];
									$projectTableLocale->insert($detailData);	
								}
								foreach($activeLocalesArray as $locale)
								{
									if($locale['id'] == $this->config['global_locale_id'])
										continue;
										
									$existLocaleRecordID = $this->AdminfunctionsPlugin()->validateduplicateLocaleCSV('beneficiary_media_gallery_locale',$existRecordID,'beneficiary_media_gallery_id','id',$this->dbAdapter,$locale['id'],'locale_id'); 
									
									$detailData = array();
									$detailData['alias'] = $data[$column_index++];
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
										$detailData['beneficiary_id']= $getBeneficiaryID1;
										$detailData['beneficiary_media_gallery_id'] = $existRecordID;
										$detailData['locale_id'] = $locale['id'];							
										$projectTableLocale->insert($detailData);	
									}
								
								}
							}
						}
						$result['status'] = 'OK';
						$result['message1'] = 'Csv imported successfully.';
						$this->memCached->setItem('aula_gallery_data','');
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
		
		$csvData .= "#ID,Media File,Media Type,Media File Type,Media Status,Beneficiary,Beneficiary Profile Family,Published(Yes|No),";
		foreach($activeLocalesArray as $locale)
		{
			$csvData .= "Alias(".$locale['name']."),";
			$csvData .= "Intro Text(".$locale['name']."),";
			
		}
		$csvData .= "\n";
		header('Content-Type: text/csv; charset=utf-8');
		header("Content-Disposition: attachment; filename=gallery.csv");
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
			
			
			$this->AdminfunctionsPlugin()->validateduplicatelocale($tableName,$ID,$fieldName,$EDIT_ID,'beneficiary_media_gallery_id',$this->dbAdapter,$this->config);           
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
            $activeLocalesArray = $this->AdminfunctionsPlugin()->getActiveLocales($this->dbAdapter);
			$iID = $this->request->getPost("KEY_ID");
			
			if($this->memCached->hasItem('aula_gallery_data') && is_array($this->memCached->getItem('aula_gallery_data')))
			{
				$menu_item = $this->memCached->getItem('aula_gallery_data');
				$rowset[0] = $menu_item[$iID];
			}
			else
			{
				$projectTable = new TableGateway('beneficiary_media_gallery', $this->dbAdapter);
				$rowset = $projectTable->select(array('id' => $iID));
				$rowset = $rowset->toArray();
			}

            foreach ($rowset as $record)
			{
				foreach($activeLocalesArray as $locale)
				{
					
					$sQuery_locale 		= "SELECT alias,intro_text FROM beneficiary_media_gallery_locale WHERE locale_id = '".$locale['id']."' AND beneficiary_media_gallery_id = '".$record['id']."' ";
					$statement_locale	= $this->dbAdapter->createStatement($sQuery_locale, $optionalParameters);        
					$resultData_locale	= $statement_locale->execute();        
					$resultSet_locale	= new ResultSet; 			   
					$resultSet_locale->initialize($resultData_locale);        
					$rowset_locale		= $resultSet_locale->toArray();
					$record['alias_'.$locale['id']] = $rowset_locale[0]['alias'];
					$record['intro_text_'.$locale['id']] = $rowset_locale[0]['intro_text'];
				}
				
                $recs[] = $record;
				$beneficiary_profile_family_id=$recs[0]['beneficiary_profile_family_id'];
				unset($recs[0]['beneficiary_profile_family_id']);
				$recs[0]['beneficiary_profile_family_id']=$beneficiary_profile_family_id;
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

            $projectTable = new TableGateway('beneficiary_media_gallery', $this->dbAdapter);
			$projectTableLocale = new TableGateway('beneficiary_media_gallery_locale', $this->dbAdapter);

            if ($this->request->getPost("pAction") == "DELETE") {
                $iMasterID = $this->request->getPost("KEY_ID");
				
				$projectTable->delete(array("id=".$iMasterID));
				$projectTableLocale->delete(array("beneficiary_media_gallery_id=".$iMasterID));
				$this->memCached->setItem('aula_gallery_data','');
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
		$tableName = 'beneficiary_media_gallery';
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
			$this->memCached->setItem('aula_gallery_data','');
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
		$tableName = 'beneficiary_media_gallery';
		$tableNameLocale = 'beneficiary_media_gallery_locale';
        if ($this->request->isPost()) {

            $projectTable = new TableGateway($tableName,$this->dbAdapter);
			$projectTableLocale = new TableGateway($tableNameLocale,$this->dbAdapter);
			
			$aData = json_decode($this->request->getPost("FORM_DATA"));
			$aData = (array)$aData;			
			
			$aData['published'] = $this->setCheckboxValue($aData,'published','Yes','No');

			if ($this->request->getPost("pAction") == "ADD")
			{
				$sql="select sequence from beneficiary_media_gallery order by sequence DESC LIMIT 1 ";
				
				$optionalParameters	= array();        
				$statement 			= $this->dbAdapter->createStatement($sql, $optionalParameters);        
				$resultData			= $statement->execute();        
				$resultSet 			= new ResultSet; 			   
				$resultSet->initialize($resultData);        
				$rowset 			= $resultSet->toArray();
				
				$masterData = array();
				$info=mime_content_type($this->config['site_dir_path']['public_dir_path']."uploads/localeicons/".$aData['pathhidden']);
				$size = filesize($this->config['site_dir_path']['public_dir_path']."uploads/localeicons/".$aData['pathhidden']);
				$path=$aData['pathhidden'];
				unset($aData['pathhidden']);
				$masterData['size'] 						= $size;
				$masterData['mime_type'] 					= $info;
				if($path != "")
				{
					$masterData['path']=$path;
				}
				$masterData['media_type_id'] 				= $aData['media_type_id'];
				$masterData['media_filetype_id']			= $aData['media_filetype_id'];
				$masterData['media_status_id'] 				= $aData['media_status_id'];
				$masterData['sequence'] 					= $rowset[0]['sequence']+1;
				$masterData['beneficiary_profile_family_id']= $aData['beneficiary_profile_family_id'];
				$masterData['beneficiary_id'] 				= $aData['beneficiary_id'];
				$masterData['published'] 					= $aData['published'];
				
				$masterData['owner_organization_id'] 		= self::$Aula_OwnerOrgID;
				$masterData['owner_organization_user_id'] 	= self::$Aula_OwnerOrgUserID;
				$projectTable->insert($masterData);	
				$iMasterID = $projectTable->lastInsertValue;	
				foreach($activeLocalesArray as $locale)
				{
					$detailData = array();
					$detailData['alias']						 = $aData['alias_'.$locale['id']];
					$detailData['intro_text'] 					 = $aData['intro_text_'.$locale['id']];
					$detailData['locale_id'] 					 = $locale['id'];
					$detailData['beneficiary_media_gallery_id']  = $iMasterID;
					$detailData['beneficiary_id']  		 		 = $aData['beneficiary_id'];
					
					$detailData['owner_organization_id'] 		 = self::$Aula_OwnerOrgID;
					$detailData['owner_organization_user_id']  	 = self::$Aula_OwnerOrgUserID;
				
					$projectTableLocale->insert($detailData);	
				}									
				$result['DBStatus'] = 'OK';
			}
			else  if($this->request->getPost("pAction") == "EDIT")
			{			
				$iMasterID=$aData['MASTER_KEY_ID'];				
				
				$info=mime_content_type($this->config['site_dir_path']['public_dir_path']."uploads/localeicons/".$aData['pathhidden']);
				$size = filesize($this->config['site_dir_path']['public_dir_path']."uploads/localeicons/".$aData['pathhidden']);
				$path=$aData['pathhidden'];
				unset($aData['pathhidden']);
				$masterData['size'] 						= $size;
				$masterData['mime_type'] 					= $info;
				if($path != "")
				{
					$masterData['path']=$path;
				}
				$masterData['media_type_id'] 				= $aData['media_type_id'];
				$masterData['media_filetype_id']			= $aData['media_filetype_id'];
				$masterData['media_status_id'] 				= $aData['media_status_id'];
				$masterData['beneficiary_profile_family_id']= $aData['beneficiary_profile_family_id'];
				$masterData['beneficiary_id'] 				= $aData['beneficiary_id'];
				$masterData['published'] 					= $aData['published'];
				$masterData['date_updated'] 				= date('Y-m-d H:i:s');
				
				$projectTable->update($masterData,array("id=".$iMasterID));
				foreach($activeLocalesArray as $locale)
				{
					$detailData = array();
					$detailData['alias']						 = $aData['alias_'.$locale['id']];
					$detailData['intro_text'] 					 = $aData['intro_text_'.$locale['id']];
					
					
					$rowset = $projectTableLocale->select(array("beneficiary_media_gallery_id=".$iMasterID,"locale_id=".$locale['id']));
					$rowset = $rowset->toArray();
					if(isset($rowset[0]['id']) && $rowset[0]['id'] > 0 ) 
					{				
						$detailData['date_updated'] = date('Y-m-d H:i:s');
						$projectTableLocale->update($detailData,array("id=".$rowset[0]['id']));						
					} 
					else 
					{
						$detailData['locale_id'] 					 = $locale['id'];
						$detailData['beneficiary_media_gallery_id']  = $iMasterID;						
						$detailData['owner_organization_id'] = self::$Aula_OwnerOrgID;
						$detailData['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;
						$detailData['beneficiary_id']  		 		 = $aData['beneficiary_id'];
						$projectTableLocale->insert($detailData);	
					}
				}									
				$result['DBStatus'] = 'OK';
			}
			$this->memCached->setItem('aula_gallery_data','');
        }
        else
        {
            $result['DBStatus'] = 'ERR';
        }

        $result = json_encode($result);
        echo $result;
        exit;
    }
	public function getbeneficiarymediagalleryAction() 
	{                
		$sql="select id as id,alias as name,published from view_beneficiary_media_gallery where published='Yes' ";	
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
	public function publishedgalleryAction()
    {        
		$tableName = 'beneficiary_media_gallery';
        if ($this->request->isPost()) {

            $projectTable = new TableGateway($tableName,$this->dbAdapter);
			
			$published = $this->request->getPost("published");
			$iMasterID = $this->request->getPost("gridID");
			$publishedarray = array();
			$publishedarray['published']=$published;
			$projectTable->update($publishedarray,array("id=".$iMasterID));
				
			$this->memCached->setItem('aula_gallery_data','');
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
	 
	
	
	public function youtubeexportcsvAction()
	{
		if ($this->request->isPost()) 
		{
			$activeLocalesArray = $this->AdminfunctionsPlugin()->getActiveLocales($this->dbAdapter);		
			
			$csvData = '';		
			$sql = "SELECT * FROM view_beneficiary_media_youtube_gallery WHERE 1 = 1";
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
			$csvData .= "#ID,Youtube Link,Media Status,Sequence,Beneficiary,Beneficiary Profile Family(First name of the beneficiary family),Published(Yes|No),";
			foreach($activeLocalesArray as $locale)
			{
				$csvData .= "Alias(".$locale['name']."),";
				$csvData .= "Intro Text(".$locale['name']."),";
				
			}
			$csvData .= "\n";
				
			
			foreach($rowset as $row)
			{
				
				$csvData .= $row['id'].",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['youtube_link']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['media_status']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['beneficiary']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['beneficiary_profile_family']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['published']).",";
				foreach($activeLocalesArray as $locale)
					{
						$sQuery_locale1 		= "SELECT alias,intro_text FROM beneficiary_media_youtube_gallery_locale WHERE locale_id = '".$locale['id']."' AND beneficiary_media_youtube_gallery_id = '".$row['id']."' ";
						$statement_locale	= $this->dbAdapter->createStatement($sQuery_locale1, $optionalParameters);        
						$resultData_locale	= $statement_locale->execute();        
						$resultSet_locale	= new ResultSet; 			   
						$resultSet_locale->initialize($resultData_locale);        
						$rowset_locale		= $resultSet_locale->toArray();
						$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($rowset_locale[0]['alias']).",";
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
	public function validateduplicateyoutubeAction()
    {
        if ($this->request->isPost()) {
            $tableName = $this->request->getPost('tableName');
            $ID = $this->request->getPost('KEY_ID');
			$EDIT_ID = $this->request->getPost('iActiveID');
            $fieldName = $this->request->getPost('fieldName'); 
			
			
			$this->AdminfunctionsPlugin()->validateduplicatelocale($tableName,$ID,$fieldName,$EDIT_ID,'beneficiary_media_youtube_gallery_id',$this->dbAdapter,$this->config);           
        }
		else {
			$result1['DBStatus'] = 'ERR';
			$result1 = json_encode($result1);
			echo $result1;
		}
        exit;
    }
	public function downloadyoutubetemplateAction()
	{
		$activeLocalesArray = $this->AdminfunctionsPlugin()->getActiveLocales($this->dbAdapter);
		$csvData = '';		
		
		$csvData .= "#ID,Youtube Link,Media Status,Beneficiary,Beneficiary Profile Family(First name of the beneficiary family),Published(Yes|No),";
		
		foreach($activeLocalesArray as $locale)
		{
			$csvData .= "Alias(".$locale['name']."),";
			$csvData .= "Intro Text(".$locale['name']."),";
			
		}
		$csvData .= "\n";
		header('Content-Type: text/csv; charset=utf-8');
		header("Content-Disposition: attachment; filename=youtube_gallery.csv");
		echo $csvData;
		exit;
	}
	public function getrecyoutubeAction()
    {
        $recs=array();
        if ($this->request->isPost()) {
            $activeLocalesArray = $this->AdminfunctionsPlugin()->getActiveLocales($this->dbAdapter);
			$iID = $this->request->getPost("KEY_ID");
			
			if($this->memCached->hasItem('aula_youtube_gallery_data') && is_array($this->memCached->getItem('aula_youtube_gallery_data')))
			{
				$menu_item = $this->memCached->getItem('aula_youtube_gallery_data');
				$rowset[0] = $menu_item[$iID];
			}
			else
			{
				$projectTable = new TableGateway('beneficiary_media_youtube_gallery', $this->dbAdapter);
				$rowset = $projectTable->select(array('id' => $iID));
				$rowset = $rowset->toArray();
			}

            foreach ($rowset as $record)
			{
				foreach($activeLocalesArray as $locale)
				{
					
					$sQuery_locale 		= "SELECT alias,intro_text FROM beneficiary_media_youtube_gallery_locale WHERE locale_id = '".$locale['id']."' AND beneficiary_media_youtube_gallery_id = '".$record['id']."' ";
					$statement_locale	= $this->dbAdapter->createStatement($sQuery_locale, $optionalParameters);        
					$resultData_locale	= $statement_locale->execute();        
					$resultSet_locale	= new ResultSet; 			   
					$resultSet_locale->initialize($resultData_locale);        
					$rowset_locale		= $resultSet_locale->toArray();
					$record['alias_'.$locale['id']] = $rowset_locale[0]['alias'];
					$record['intro_text_'.$locale['id']] = $rowset_locale[0]['intro_text'];
				}
				$published=$record['published'];
				unset($record['published']);
				$record['published_youtube']=$published;
				
                $recs[] = $record;
				$beneficiary_profile_family_id=$recs[0]['beneficiary_profile_family_id'];
				unset($recs[0]['beneficiary_profile_family_id']);
				$recs[0]['beneficiary_profile_family_id']=$beneficiary_profile_family_id;
			}
            $result['data'] = $recs;
            $result['recordsTotal'] = count($recs);
            $result['DBStatus'] = 'OK';

            $result = json_encode($result);
            echo $result;
            exit;
        }
    }
	public function youtubeimportcsvAction()
    {			
		$activeLocalesArray = $this->AdminfunctionsPlugin()->getActiveLocales($this->dbAdapter);
        $projectTable = new TableGateway('beneficiary_media_youtube_gallery',$this->dbAdapter);
		$projectTableLocale = new TableGateway('beneficiary_media_youtube_gallery_locale',$this->dbAdapter);
		if ($this->request->isPost()) {

            $file = $_FILES['importyoutubefile'];
            $filename = $_FILES['importyoutubefile']['name'];
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
							if($data[1] != "" && $data[2] != "" && $data[3] != "" && $data[4] != "" && $data[5] != "" && $data[6] != ""&& $data[7] != "")
							{
								$saveDataArray = array();
								$column_index = 1;
								$saveDataArray['youtube_link'] 	= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								
							 	$getMediaStatusID = $this->AdminfunctionsPlugin()->validateduplicateLocaleCSV('media_status_locale',$this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]),'name','media_status_id',$this->dbAdapter,$this->config['global_locale_id'],'locale_id');
								$saveDataArray['media_status_id']= $getMediaStatusID;
														
								$getBeneficiaryID = $this->AdminfunctionsPlugin()->validateduplicateLocaleCSV('beneficiary_locale',$this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]),'family_name','beneficiary_id',$this->dbAdapter,$this->config['global_locale_id'],'locale_id');
								$saveDataArray['beneficiary_id']= $getBeneficiaryID;
								if(!($saveDataArray['beneficiary_id'] > 0))
								{
									continue;
								}
								$getProfileFamilyID = $this->AdminfunctionsPlugin()->validateduplicateLocaleCSV('beneficiary_profile_family_locale',$this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]),'first_name','beneficiary_profile_family_id',$this->dbAdapter,$this->config['global_locale_id'],'locale_id');
								$saveDataArray['beneficiary_profile_family_id']= $getProfileFamilyID;
								if(!($saveDataArray['beneficiary_profile_family_id'] > 0))
								{
									continue;
								}
								
								$saveDataArray['published'] 	= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$detailData = array();
								$detailData['alias'] = $data[$column_index++];
								$detailData['intro_text'] = $data[$column_index++];
								/*$existRecordID = $this->AdminfunctionsPlugin()->validateduplicateCSV('view_beneficiary_media_youtube_gallery',$detailData['alias'],'alias',$this->dbAdapter,$data[0]);	
								if($existRecordID > 0 )
								{
									continue;
								}*/
								$existRecordID = $data[0]; 
								if($existRecordID > 0)
								{
									$saveDataArray['date_updated'] = date('Y-m-d H:i:s');		
									$projectTable->update($saveDataArray,array("id=".$existRecordID));
									
									$detailData['date_updated'] = date('Y-m-d H:i:s');
									$projectTableLocale->update($detailData,array("beneficiary_media_youtube_gallery_id=".$existRecordID,"locale_id=".$this->config['global_locale_id']));	
								}
								else
								{
									
									$saveDataArray['owner_organization_id'] = self::$Aula_OwnerOrgID;
									$saveDataArray['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;								
									$projectTable->insert($saveDataArray);	
									$existRecordID = $projectTable->lastInsertValue;
									
									$sql="select sequence from beneficiary_media_youtube_gallery order by sequence DESC LIMIT 1 ";
				
									$optionalParameters	= array();        
									$statement 			= $this->dbAdapter->createStatement($sql, $optionalParameters);        
									$resultData			= $statement->execute();        
									$resultSet 			= new ResultSet; 			   
									$resultSet->initialize($resultData);        
									$rowset 			= $resultSet->toArray();	
									
									$detailData['owner_organization_id'] = self::$Aula_OwnerOrgID;
									$detailData['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;	
									$detailData['beneficiary_media_youtube_gallery_id'] = $existRecordID;
									$detailData['beneficiary_id']= $getBeneficiaryID;
									$detailData['sequence']= $rowset[0]['sequence']+1;
									$detailData['locale_id'] = $this->config['global_locale_id'];							
									$projectTableLocale->insert($detailData);	
								}
								foreach($activeLocalesArray as $locale)
								{
									if($locale['id'] == $this->config['global_locale_id'])
										continue;
										
									$existLocaleRecordID = $this->AdminfunctionsPlugin()->validateduplicateLocaleCSV('beneficiary_media_youtube_gallery_locale',$existRecordID,'beneficiary_media_youtube_gallery_id','id',$this->dbAdapter,$locale['id'],'locale_id'); 
									
									$detailData = array();
									$detailData['alias'] = $data[$column_index++];
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
										$detailData['beneficiary_media_youtube_gallery_id'] = $existRecordID;
										$detailData['beneficiary_id']= $getBeneficiaryID;
										$detailData['locale_id'] = $locale['id'];							
										$projectTableLocale->insert($detailData);	
									}
								
								}
							}
						}
						$result['status'] = 'OK';
						$result['message1'] = 'Csv imported successfully.';
						$this->memCached->setItem('aula_youtube_gallery_data','');
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
	public function  deleteyoutubeAction()
    {
        
        if ($this->request->isPost()) {

            $projectTable = new TableGateway('beneficiary_media_youtube_gallery', $this->dbAdapter);
			$projectTableLocale = new TableGateway('beneficiary_media_youtube_gallery_locale', $this->dbAdapter);

            if ($this->request->getPost("pAction") == "DELETE") {
                $iMasterID = $this->request->getPost("KEY_ID");
				
				$projectTable->delete(array("id=".$iMasterID));
				$projectTableLocale->delete(array("beneficiary_media_youtube_gallery_id=".$iMasterID));
				$this->memCached->setItem('aula_youtube_gallery_data','');
                $result['DBStatus'] = 'OK';
                $result = json_encode($result);
                echo $result;
                exit;
            }
        }
    }
	public function bulksaveyoutubeAction()
    {        
		$tableName = 'beneficiary_media_youtube_gallery';
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
				$updateData['published'] = $this->setCheckboxValue($aData,'published_youtube'.$iMasterID,'Yes','No');
				
				$projectTable->update($updateData,array("id=".$iMasterID));				
			}
			$this->memCached->setItem('aula_youtube_gallery_data','');
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
	public function listyoutubeAction()
    {
        echo $this->fnYoutubeGrid();
        exit;
    }
	public function fnYoutubeGrid()
	{
		$activeLocalesArray = $this->AdminfunctionsPlugin()->getActiveLocales($this->dbAdapter);
		$aColumns = array( '`id`','`alias`','`beneficiary`','`beneficiary_profile_family`','`youtube_link`','`media_status`','`published`');
		if(!($this->memCached->hasItem('aula_youtube_gallery_data')) || !is_array($this->memCached->getItem('aula_youtube_gallery_data')))
		{	
			$sTable = 'view_beneficiary_media_youtube_gallery';
		
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
					$sQuery_locale 		= "SELECT alias,intro_text FROM beneficiary_media_youtube_gallery_locale WHERE locale_id = '".$locale['id']."' AND beneficiary_media_youtube_gallery_id = '".$aRow['id']."' ";
					$statement_locale	= $this->dbAdapter->createStatement($sQuery_locale, $optionalParameters);        
					$resultData_locale	= $statement_locale->execute();        
					$resultSet_locale	= new ResultSet; 			   
					$resultSet_locale->initialize($resultData_locale);        
					$rowset_locale		= $resultSet_locale->toArray();
					$aRow['alias_'.$locale['id']] = $rowset_locale[0]['alias'];
					$aRow['intro_text_'.$locale['id']] = $rowset_locale[0]['intro_text'];
				}
				$rowsetCache[$aRow['id']] = $aRow;
			}
			$this->memCached->setItem('aula_youtube_gallery_data',$rowsetCache);
		}
			
		$rowset = $this->memCached->getItem('aula_youtube_gallery_data');
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
	public function savemediayoutubegalleryAction()
    { 
		$activeLocalesArray = $this->AdminfunctionsPlugin()->getActiveLocales($this->dbAdapter);       
		$tableName = 'beneficiary_media_youtube_gallery';
		$tableNameLocale = 'beneficiary_media_youtube_gallery_locale';
        if ($this->request->isPost()) {

            $projectTable = new TableGateway($tableName,$this->dbAdapter);
			$projectTableLocale = new TableGateway($tableNameLocale,$this->dbAdapter);
			
			$aData = json_decode($this->request->getPost("FORM_DATA"));
			$aData = (array)$aData;			
			
			$aData['published_youtube'] = $this->setCheckboxValue($aData,'published_youtube','Yes','No');

			if ($this->request->getPost("pAction") == "ADD")
			{
				$sql="select sequence from beneficiary_media_youtube_gallery order by sequence DESC LIMIT 1 ";
				
				$optionalParameters	= array();        
				$statement 			= $this->dbAdapter->createStatement($sql, $optionalParameters);        
				$resultData			= $statement->execute();        
				$resultSet 			= new ResultSet; 			   
				$resultSet->initialize($resultData);        
				$rowset 			= $resultSet->toArray();
				
				$masterData = array();
				
				$masterData['youtube_link'] 				= $aData['youtube_link'];
				$masterData['media_status_id'] 				= $aData['media_status_id'];
				$masterData['sequence'] 					= $rowset[0]['sequence']+1;
				$masterData['beneficiary_profile_family_id']= $aData['beneficiary_profile_family_id'];
				$masterData['beneficiary_id'] 				= $aData['beneficiary_id'];
				$masterData['published'] 					= $aData['published_youtube'];
				
				$masterData['owner_organization_id'] 		= self::$Aula_OwnerOrgID;
				$masterData['owner_organization_user_id'] 	= self::$Aula_OwnerOrgUserID;
				$projectTable->insert($masterData);	
				$iMasterID = $projectTable->lastInsertValue;	
				foreach($activeLocalesArray as $locale)
				{
					$detailData = array();
					$detailData['alias']						 = $aData['alias_'.$locale['id']];
					$detailData['intro_text'] 					 = $aData['intro_text_'.$locale['id']];
					$detailData['locale_id'] 					 = $locale['id'];
					$detailData['beneficiary_media_youtube_gallery_id']  = $iMasterID;
					$detailData['beneficiary_id']  		 		 = $aData['beneficiary_id'];
					
					$detailData['owner_organization_id'] 		 = self::$Aula_OwnerOrgID;
					$detailData['owner_organization_user_id']  	 = self::$Aula_OwnerOrgUserID;
				
					$projectTableLocale->insert($detailData);	
				}									
				$result['DBStatus'] = 'OK';
			}
			else  if($this->request->getPost("pAction") == "EDIT")
			{			
				$iMasterID=$aData['MASTER_KEY_ID'];				
				
				
				
				$masterData['youtube_link'] 				= $aData['youtube_link'];
				$masterData['media_status_id'] 				= $aData['media_status_id'];
				$masterData['beneficiary_profile_family_id']= $aData['beneficiary_profile_family_id'];
				$masterData['beneficiary_id'] 				= $aData['beneficiary_id'];
				$masterData['published'] 					= $aData['published_youtube'];
				$masterData['date_updated'] 				= date('Y-m-d H:i:s');
				
				$projectTable->update($masterData,array("id=".$iMasterID));
				foreach($activeLocalesArray as $locale)
				{
					$detailData = array();
					$detailData['alias']						 = $aData['alias_'.$locale['id']];
					$detailData['intro_text'] 					 = $aData['intro_text_'.$locale['id']];
					$detailData['beneficiary_id']  		 		 = $aData['beneficiary_id'];
					
					$rowset = $projectTableLocale->select(array("beneficiary_media_youtube_gallery_id=".$iMasterID,"locale_id=".$locale['id']));
					$rowset = $rowset->toArray();
					if(isset($rowset[0]['id']) && $rowset[0]['id'] > 0 ) 
					{				
						$detailData['date_updated'] = date('Y-m-d H:i:s');
						$projectTableLocale->update($detailData,array("id=".$rowset[0]['id']));						
					} 
					else 
					{
						$detailData['locale_id'] 					 = $locale['id'];
						$detailData['beneficiary_media_youtube_gallery_id']  = $iMasterID;						
						$detailData['owner_organization_id'] = self::$Aula_OwnerOrgID;
						$detailData['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;
						$projectTableLocale->insert($detailData);	
					}
				}									
				$result['DBStatus'] = 'OK';
			}
			$this->memCached->setItem('aula_youtube_gallery_data','');
        }
        else
        {
            $result['DBStatus'] = 'ERR';
        }

        $result = json_encode($result);
        echo $result;
        exit;
    } 
	public function publishedyoutubeAction()
    {        
		$tableName = 'beneficiary_media_youtube_gallery';
        if ($this->request->isPost()) {

            $projectTable = new TableGateway($tableName,$this->dbAdapter);
			
			$published = $this->request->getPost("published");
			$iMasterID = $this->request->getPost("gridID");
			$publishedarray = array();
			$publishedarray['published']=$published;
			$projectTable->update($publishedarray,array("id=".$iMasterID));
				
			$this->memCached->setItem('aula_youtube_gallery_data','');
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

}