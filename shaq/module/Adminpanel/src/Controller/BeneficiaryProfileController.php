<?php
namespace Aula_Adminpanel\Controller;

use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Db\Sql\Sql as Sql;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Adapter\AdapterInterface;

class BeneficiaryProfileController extends AbstractActionController
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
		$aColumns = array( '`id`','`name`','`published`','`country_name`','`beneficiary_name`',);
		if(!($this->memCached->hasItem('aula_beneficiary_profile_data')) || !is_array($this->memCached->getItem('aula_beneficiary_profile_data')))
		{	
			$sTable = 'view_beneficiary_profile';
		
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
					$sQuery_locale 		= "SELECT name,description FROM beneficiary_profile_locale WHERE locale_id = '".$locale['id']."' AND beneficiary_profile_id = '".$aRow['id']."' ";
					$statement_locale	= $this->dbAdapter->createStatement($sQuery_locale, $optionalParameters);        
					$resultData_locale	= $statement_locale->execute();        
					$resultSet_locale	= new ResultSet; 			   
					$resultSet_locale->initialize($resultData_locale);        
					$rowset_locale		= $resultSet_locale->toArray();
					$aRow['name_'.$locale['id']] = $rowset_locale[0]['name'];
					$aRow['description_'.$locale['id']] = $rowset_locale[0]['description'];
				}
				$rowsetCache[$aRow['id']] = $aRow;
			}
			$this->memCached->setItem('aula_beneficiary_profile_data',$rowsetCache);
		}
			
		$rowset = $this->memCached->getItem('aula_beneficiary_profile_data');
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
			$sql = "SELECT * FROM view_beneficiary_profile WHERE 1 = 1";
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
			$csvData .= "#ID,Details,Family,Family Flag,Income,Spending,Home,Asset,Asset Required,Education,Medical,Medical Examination,Disabled,Volunteer,Gallery,Research Notes,Published,Country,Beneficiary,";
			foreach($activeLocalesArray as $locale)
			{
				$csvData .= "Family Name(".$locale['name']."),";
				$csvData .= "Intro Text(".$locale['name']."),";
				
			}
			$csvData .= "\n";
				
			
			foreach($rowset as $row)
			{
				
				$csvData .= $row['id'].",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['details']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['family']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['family_flag']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['income']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['spending']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['home']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['asset']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['asset_required']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['education']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['medical']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['medical_examination']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['disabled']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['volunteer']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['gallery']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['research_notes']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['published']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['country_name']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['beneficiary_name']).",";

				foreach($activeLocalesArray as $locale)
					{
						$sQuery_locale1 		= "SELECT name,description FROM beneficiary_profile_locale WHERE locale_id = '".$locale['id']."' AND beneficiary_profile_id = '".$row['id']."' ";
						$statement_locale	= $this->dbAdapter->createStatement($sQuery_locale1, $optionalParameters);        
						$resultData_locale	= $statement_locale->execute();        
						$resultSet_locale	= new ResultSet; 			   
						$resultSet_locale->initialize($resultData_locale);        
						$rowset_locale		= $resultSet_locale->toArray();
						$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($rowset_locale[0]['name']).",";
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
        $projectTable = new TableGateway('beneficiary_profile',$this->dbAdapter);
		$projectTableLocale = new TableGateway('beneficiary_profile_locale',$this->dbAdapter);
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
							if($data[1] != "" && $data[2] != "" && $data[3] != ""&& $data[4] != ""&& $data[5] != ""&& $data[6] != ""&& $data[7] != "" && $data[8] != ""&& $data[9] != ""&& $data[10] != ""&& $data[11] != ""&& $data[12] != ""&& $data[13] != ""&& $data[14] != ""&& $data[15] != ""&& $data[16] != ""&& $data[17] != ""&& $data[18] != ""&& $data[19] != "")
							{
								$saveDataArray = array();
								$column_index = 1;
							 	
								$saveDataArray['details'] 				= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$saveDataArray['family'] 				= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$saveDataArray['family_flag'] 			= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$saveDataArray['income'] 				= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$saveDataArray['spending'] 				= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$saveDataArray['home'] 					= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$saveDataArray['asset'] 				= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$saveDataArray['asset_required'] 		= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$saveDataArray['education'] 			= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$saveDataArray['medical'] 				= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$saveDataArray['medical_examination'] 	= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$saveDataArray['disabled'] 				= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$saveDataArray['volunteer'] 			= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$saveDataArray['gallery'] 				= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$saveDataArray['research_notes'] 		= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$saveDataArray['published'] 			= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								
								$getCountryID = $this->AdminfunctionsPlugin()->validateduplicateLocaleCSV('country_locale',$this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]),'name','country_id',$this->dbAdapter,$this->config['global_locale_id'],'locale_id');
								$saveDataArray['country_id']			= $getCountryID;
								
								$getBeneficiaryID = $this->AdminfunctionsPlugin()->validateduplicateLocaleCSV('beneficiary_locale',$this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]),'family_name','beneficiary_id',$this->dbAdapter,$this->config['global_locale_id'],'locale_id');
								$saveDataArray['beneficiary_id'] 			= $getBeneficiaryID;
								
								
								$detailData = array();
								$detailData['name'] = $data[$column_index++];
								$detailData['description'] = $data[$column_index++];
								
								$existRecordID = $data[0]; 
								if($existRecordID > 0)
								{
									$saveDataArray['date_updated'] = date('Y-m-d H:i:s');		
									$projectTable->update($saveDataArray,array("id=".$existRecordID));
									
									$detailData['date_updated'] = date('Y-m-d H:i:s');
									$projectTableLocale->update($detailData,array("beneficiary_profile_id=".$existRecordID,"locale_id=".$this->config['global_locale_id']));	
								}
								else
								{
									$existRecordID = $this->AdminfunctionsPlugin()->validateduplicateCSV('view_beneficiary_profile',$detailData['name'],'name',$this->dbAdapter);	
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
									$detailData['beneficiary_profile_id'] = $existRecordID;
									$detailData['locale_id'] = $this->config['global_locale_id'];							
									$projectTableLocale->insert($detailData);	
								}
								foreach($activeLocalesArray as $locale)
								{
									if($locale['id'] == $this->config['global_locale_id'])
										continue;
										
									$existLocaleRecordID = $this->AdminfunctionsPlugin()->validateduplicateLocaleCSV('beneficiary_profile_locale',$existRecordID,'beneficiary_profile_id','id',$this->dbAdapter,$locale['id'],'locale_id'); 
									
									$detailData = array();
									$detailData['name'] = $data[$column_index++];
									$detailData['description'] = $data[$column_index++];
									
									
									if($existLocaleRecordID > 0)
									{										
										$detailData['date_updated'] = date('Y-m-d H:i:s');
										$projectTableLocale->update($detailData,array("id=".$existLocaleRecordID));
									}
									else
									{										
										$detailData['owner_organization_id'] = self::$Aula_OwnerOrgID;
										$detailData['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;	
										$detailData['beneficiary_profile_id'] = $existRecordID;
										$detailData['locale_id'] = $locale['id'];							
										$projectTableLocale->insert($detailData);	
									}
								
								}
							}
						}
						$result['status'] = 'OK';
						$result['message1'] = 'Csv imported successfully.';
						$this->memCached->setItem('aula_beneficiary_profile_data','');
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
		
		$csvData .= "#ID,Details,Family,Family Flag,Income,Spending,Home,Asset,Asset Required,Education,Medical,Medical Examination,Disabled,Volunteer,Gallery,Research Notes,Published,Country,Beneficiary,";
		foreach($activeLocalesArray as $locale)
		{
				$csvData .= "Name(".$locale['name']."),";
				$csvData .= "Description(".$locale['name']."),";
			
		}
		$csvData .= "\n";
		header('Content-Type: text/csv; charset=utf-8');
		header("Content-Disposition: attachment; filename=beneficiary-profile.csv");
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
			
			
			$this->AdminfunctionsPlugin()->validateduplicatelocale($tableName,$ID,$fieldName,$EDIT_ID,'beneficiary_profile_id',$this->dbAdapter,$this->config);           
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
			
			if($this->memCached->hasItem('aula_beneficiary_profile_data') && is_array($this->memCached->getItem('aula_beneficiary_profile_data')))
			{
				$beneficiary_profilees = $this->memCached->getItem('aula_beneficiary_profile_data');
				$rowset[0] = $beneficiary_profilees[$iID];
			}
			else
			{
				$projectTable = new TableGateway('beneficiary_profile', $this->dbAdapter);
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

            $projectTable = new TableGateway('beneficiary_profile', $this->dbAdapter);
			$projectTableLocale = new TableGateway('beneficiary_profile_locale', $this->dbAdapter);

            if ($this->request->getPost("pAction") == "DELETE") {
                $iMasterID = $this->request->getPost("KEY_ID");
				
				$projectTable->delete(array("id=".$iMasterID));
				$projectTableLocale->delete(array("beneficiary_profile_id=".$iMasterID));
				$this->memCached->setItem('aula_beneficiary_profile_data','');
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
		$tableName = 'beneficiary_profile';
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
			$this->memCached->setItem('aula_beneficiary_profile_data','');
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
		$tableName = 'beneficiary_profile';
		$tableNameLocale = 'beneficiary_profile_locale';
        if ($this->request->isPost()) {

            $projectTable = new TableGateway($tableName,$this->dbAdapter);
			$projectTableLocale = new TableGateway($tableNameLocale,$this->dbAdapter);
			
			$aData = json_decode($this->request->getPost("FORM_DATA"));
			$aData = (array)$aData;			
			
			$aData['details'] 			  = $this->setCheckboxValue($aData,'details','Yes','No');
			$aData['family']    		  = $this->setCheckboxValue($aData,'family','Yes','No');
			$aData['family_flag']		  = $this->setCheckboxValue($aData,'family_flag','Yes','No');
			$aData['income'] 	 	 	  = $this->setCheckboxValue($aData,'income','Yes','No');
			$aData['spending'] 			  = $this->setCheckboxValue($aData,'spending','Yes','No');
			$aData['home'] 				  = $this->setCheckboxValue($aData,'home','Yes','No');
			$aData['asset'] 			  = $this->setCheckboxValue($aData,'asset','Yes','No');
			$aData['asset_required']	  = $this->setCheckboxValue($aData,'asset_required','Yes','No');
			$aData['education'] 		  = $this->setCheckboxValue($aData,'education','Yes','No');
			$aData['medical'] 			  = $this->setCheckboxValue($aData,'medical','Yes','No');
			$aData['medical_examination'] = $this->setCheckboxValue($aData,'medical_examination','Yes','No');
			$aData['disabled']		      = $this->setCheckboxValue($aData,'disabled','Yes','No');
			$aData['volunteer']			  = $this->setCheckboxValue($aData,'volunteer','Yes','No');
			$aData['gallery'] 			  = $this->setCheckboxValue($aData,'gallery','Yes','No');
			$aData['research_notes']	  = $this->setCheckboxValue($aData,'research_notes','Yes','No');
			$aData['published']			  = $this->setCheckboxValue($aData,'published','Yes','No');

			if ($this->request->getPost("pAction") == "ADD")
			{
				$masterData = array();
				$masterData['details'] 				= $aData['details'];
				$masterData['family'] 				= $aData['family'];
				$masterData['family_flag'] 			= $aData['family_flag'];
				$masterData['income'] 				= $aData['income'];
				$masterData['spending'] 			= $aData['spending'];
				$masterData['home'] 				= $aData['home'];
				$masterData['asset'] 				= $aData['asset'];
				$masterData['asset_required'] 		= $aData['asset_required'];
				$masterData['education'] 			= $aData['education'];
				$masterData['medical'] 				= $aData['medical'];
				$masterData['medical_examination'] 	= $aData['medical_examination'];
				$masterData['disabled'] 			= $aData['disabled'];
				$masterData['volunteer'] 			= $aData['volunteer'];
				$masterData['gallery'] 				= $aData['gallery'];
				$masterData['research_notes'] 		= $aData['research_notes'];
				$masterData['published'] 			= $aData['published'];
				$masterData['country_id'] 			= $aData['country_id'];
				$masterData['beneficiary_id'] 		= $aData['beneficiary_id'];
				
				
				$masterData['owner_organization_id'] = self::$Aula_OwnerOrgID;
				$masterData['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;
				
				$projectTable->insert($masterData);	
				$iMasterID = $projectTable->lastInsertValue;	
				foreach($activeLocalesArray as $locale)
				{
					$detailData = array();
					$detailData['name'] = $aData['name_'.$locale['id']];
					$detailData['description'] = $aData['description_'.$locale['id']];
					$detailData['locale_id'] = $locale['id'];
					$detailData['beneficiary_profile_id'] = $iMasterID;
					
					$detailData['owner_organization_id'] = self::$Aula_OwnerOrgID;
					$detailData['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;
				
					$projectTableLocale->insert($detailData);	
				}									
				$result['DBStatus'] = 'OK';
			}
			else  if($this->request->getPost("pAction") == "EDIT")
			{			
				$iMasterID=$aData['MASTER_KEY_ID'];				
				
				$masterData = array();
				$masterData['details'] 				= $aData['details'];
				$masterData['family'] 				= $aData['family'];
				$masterData['family_flag'] 			= $aData['family_flag'];
				$masterData['income'] 				= $aData['income'];
				$masterData['spending'] 			= $aData['spending'];
				$masterData['home'] 				= $aData['home'];
				$masterData['asset'] 				= $aData['asset'];
				$masterData['asset_required'] 		= $aData['asset_required'];
				$masterData['education'] 			= $aData['education'];
				$masterData['medical'] 				= $aData['medical'];
				$masterData['medical_examination'] 	= $aData['medical_examination'];
				$masterData['disabled'] 			= $aData['disabled'];
				$masterData['volunteer'] 			= $aData['volunteer'];
				$masterData['gallery'] 				= $aData['gallery'];
				$masterData['research_notes'] 		= $aData['research_notes'];
				$masterData['published'] 			= $aData['published'];
				$masterData['country_id'] 			= $aData['country_id'];
				$masterData['beneficiary_id'] 		= $aData['beneficiary_id'];
				$masterData['date_updated'] 		= date('Y-m-d H:i:s');
				
				$projectTable->update($masterData,array("id=".$iMasterID));
				foreach($activeLocalesArray as $locale)
				{
					$detailData = array();
					$detailData['name'] = $aData['name_'.$locale['id']];
					$detailData['description'] = $aData['description_'.$locale['id']];
					$detailData['date_updated'] = date('Y-m-d H:i:s');
					
					$projectTableLocale->update($detailData,array("beneficiary_profile_id=".$iMasterID,"locale_id=".$locale['id']));
				}									
				$result['DBStatus'] = 'OK';
			}
			$this->memCached->setItem('aula_beneficiary_profile_data','');
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
