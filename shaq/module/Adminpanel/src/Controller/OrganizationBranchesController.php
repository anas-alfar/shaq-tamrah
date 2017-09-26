<?php
namespace Aula_Adminpanel\Controller;

use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Db\Sql\Sql as Sql;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Adapter\AdapterInterface;

class OrganizationBranchesController extends AbstractActionController
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
		$aColumns = array( '`id`','`id`','`name`','`website`','`mobile_number`','`phone_number`','`country_name`','`city_name`','`is_main_branch`','`published`');
		if(!($this->memCached->hasItem('aula_organizationbranch_data')) || !is_array($this->memCached->getItem('aula_organizationbranch_data')))
		{	
			$sTable = 'view_organization_branch';
		
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
					$sQuery_locale 		= "SELECT name,address,description,website FROM organization_branch_locale WHERE locale_id = '".$locale['id']."' AND organization_branch_id = '".$aRow['id']."' ";
					$statement_locale	= $this->dbAdapter->createStatement($sQuery_locale, $optionalParameters);        
					$resultData_locale	= $statement_locale->execute();        
					$resultSet_locale	= new ResultSet; 			   
					$resultSet_locale->initialize($resultData_locale);        
					$rowset_locale		= $resultSet_locale->toArray();
					$aRow['name_'.$locale['id']] = $rowset_locale[0]['name'];
					$aRow['address_'.$locale['id']] = $rowset_locale[0]['address'];
					$aRow['description_'.$locale['id']] = $rowset_locale[0]['description'];
					$aRow['website_'.$locale['id']] = $rowset_locale[0]['website'];
				}
				$rowsetCache[$aRow['id']] = $aRow;
			}
			$this->memCached->setItem('aula_organizationbranch_data',$rowsetCache);
		}
			
		$rowset = $this->memCached->getItem('aula_organizationbranch_data');
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
	
	public function getgriddetailslistAction()
	{
		
		$iID = $this->request->getPost("KEY_ID");
		$branch = $this->AdminfunctionsPlugin()->getSingleRecord2('organization_branch_id',$iID,'view_organization_branch_committee',$this->dbAdapter);	
		
			$grid_list = '';
			$grid_list .= '<h5 class="gridDetailSectionHeading">Branch Commitee:  ';
			$grid_list .= '<button class="btn addEventBtn" id="btnBranchCommitee" row-id="'.$iID.'">
								<i class="fa fa-plus"></i> &nbsp;Add Commitee
							</button></h5>';
			$grid_list .= '<table cellpadding="5" cellspacing="0" border="0" class="table table-hover table-condensed gridDetailTable" id="menu_category_detail_tbl">';
			if(count($branch) > 0)
			{	
				foreach($branch as $branchdata)
				{
					$grid_list .= '<tr >
										<td>'.$branchdata['name'].'</td>
									</tr>';
				}
			}
			else
			{
				$grid_list .= '<tr >
									<td class="datafound">No Data Found</td>
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

	
	public function exportcsvAction()
	{
		if ($this->request->isPost()) 
		{
			$activeLocalesArray = $this->AdminfunctionsPlugin()->getActiveLocales($this->dbAdapter);		
			
			$csvData = '';		
			$sql = "SELECT * FROM view_organization_branch WHERE 1 = 1";
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
			$csvData .= "#ID,Mobile Number,Mobile Number 2,Phone Number,Fax,Country,City,Manager,Work Days,Work Hours,Break Hours,Geo Location,Is Main Branch(Yes|No),Published(Yes|No),";
			foreach($activeLocalesArray as $locale)
			{
				$csvData .= "Name(".$locale['name']."),";
				$csvData .= "Address(".$locale['name']."),";
				$csvData .= "Description(".$locale['name']."),";
				$csvData .= "Website(".$locale['name']."),";
				
			}
			$csvData .= "\n";
				
			
			foreach($rowset as $row)
			{
				
				$csvData .= $row['id'].",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate("M-".$row['mobile_number']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate("M-".$row['mobile_number_2']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate("P-".$row['phone_number']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate("F-".$row['fax']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['country_name']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['city_name']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['manager_id']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['work_days']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['work_hours']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['break_hours']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['geo_location']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['is_main_branch']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['published']).",";
				foreach($activeLocalesArray as $locale)
					{
						$sQuery_locale1 		= "SELECT name,address,description,website FROM organization_branch_locale WHERE locale_id = '".$locale['id']."' AND organization_branch_id = '".$row['id']."' ";
						$statement_locale	= $this->dbAdapter->createStatement($sQuery_locale1, $optionalParameters);        
						$resultData_locale	= $statement_locale->execute();        
						$resultSet_locale	= new ResultSet; 			   
						$resultSet_locale->initialize($resultData_locale);        
						$rowset_locale		= $resultSet_locale->toArray();
						$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($rowset_locale[0]['name']).",";
						$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($rowset_locale[0]['address']).",";
						$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($rowset_locale[0]['description']).",";
						$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($rowset_locale[0]['website']).",";
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
        $projectTable = new TableGateway('organization_branch',$this->dbAdapter);
		$projectTableLocale = new TableGateway('organization_branch_locale',$this->dbAdapter);
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
							if($data[1] != "" && $data[2] != "" && $data[3] != ""&& $data[4] != ""&& $data[5] != ""&& $data[6] != ""&& $data[7] != ""&& $data[8] != ""&& $data[9] != ""&& $data[10] != ""&& $data[11] != ""&& $data[12] != ""&& $data[13] != ""&& $data[14] != ""&& $data[15] != ""&& $data[16] != ""&& $data[17] != "" )
							{
								$saveDataArray = array();
								$column_index = 1;
								$saveDataArray['mobile_number'] 	= $this->AdminfunctionsPlugin()->importDataValidate(str_replace("M-", "", $data[$column_index++]));
								$saveDataArray['mobile_number_2'] 	= $this->AdminfunctionsPlugin()->importDataValidate(str_replace("M-", "",$data[$column_index++]));
								$saveDataArray['phone_number'] 		= $this->AdminfunctionsPlugin()->importDataValidate(str_replace("P-", "",$data[$column_index++]));
								$saveDataArray['fax'] 				= $this->AdminfunctionsPlugin()->importDataValidate(str_replace("F-", "",$data[$column_index++]));
								
								$getCountryID = $this->AdminfunctionsPlugin()->validateduplicateLocaleCSV('country_locale',$this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]),'name','country_id',$this->dbAdapter,$this->config['global_locale_id'],'locale_id');
								$saveDataArray['country_id']= $getCountryID;
								
								$getCityID = $this->AdminfunctionsPlugin()->validateduplicateLocaleCSV('city_locale',$this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]),'name','city_id',$this->dbAdapter,$this->config['global_locale_id'],'locale_id');
								$saveDataArray['city_id'] 	= $getCityID;
								
								$saveDataArray['manager_id'] 		= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$saveDataArray['work_days'] 		= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$saveDataArray['work_hours'] 		= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$saveDataArray['break_hours'] 		= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$saveDataArray['geo_location'] 		= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$saveDataArray['is_main_branch'] 	= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$saveDataArray['published'] 		= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
							 	
								
								
								$detailData = array();
								$detailData['name'] = $data[$column_index++];
								$detailData['address'] = $data[$column_index++];
								$detailData['description'] = $data[$column_index++];
								$detailData['website'] = $data[$column_index++];
								
								$existRecordID = $this->AdminfunctionsPlugin()->validateduplicateCSV('view_organization_branch',$detailData['name'],'name',$this->dbAdapter,$data[0]);	
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
									$projectTableLocale->update($detailData,array("organization_branch_id=".$existRecordID,"locale_id=".$this->config['global_locale_id']));	
								}
								else
								{
									
									$saveDataArray['organization_id'] = self::$Aula_OrgID;
									$saveDataArray['owner_organization_id'] = self::$Aula_OwnerOrgID;
									$saveDataArray['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;								
									$projectTable->insert($saveDataArray);	
									$existRecordID = $projectTable->lastInsertValue;	
									
									$detailData['organization_id'] = self::$Aula_OrgID;
									$detailData['owner_organization_id'] = self::$Aula_OwnerOrgID;
									$detailData['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;	
									$detailData['organization_branch_id'] = $existRecordID;
									$detailData['locale_id'] = $this->config['global_locale_id'];							
									$projectTableLocale->insert($detailData);	
								}
								foreach($activeLocalesArray as $locale)
								{
									if($locale['id'] == $this->config['global_locale_id'])
										continue;
										
									$existLocaleRecordID = $this->AdminfunctionsPlugin()->validateduplicateLocaleCSV('organization_branch_locale',$existRecordID,'organization_branch_id','id',$this->dbAdapter,$locale['id'],'locale_id'); 
									
									$detailData = array();
									$detailData['name'] = $data[$column_index++];
									$detailData['address'] = $data[$column_index++];
									$detailData['description'] = $data[$column_index++];
									$detailData['website'] = $data[$column_index++];
									
									
									if($existLocaleRecordID > 0)
									{										
										$detailData['date_updated'] = date('Y-m-d H:i:s');
										$projectTableLocale->update($detailData,array("id=".$existLocaleRecordID));
									}
									else
									{	
										$detailData['organization_id'] = self::$Aula_OrgID;									
										$detailData['owner_organization_id'] = self::$Aula_OwnerOrgID;
										$detailData['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;	
										$detailData['organization_branch_id'] = $existRecordID;
										$detailData['locale_id'] = $locale['id'];							
										$projectTableLocale->insert($detailData);	
									}
								
								}
							}
						}
						$result['status'] = 'OK';
						$result['message1'] = 'Csv imported successfully.';
						$this->memCached->setItem('aula_organizationbranch_data','');
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
		
		$csvData .= "#ID,Mobile Number,Mobile Number 2,Phone Number,Fax,Country,City,Manager,Work Days,Work Hours,Break Hours,Is Main Branch(Yes|No),Published(Yes|No),";
		foreach($activeLocalesArray as $locale)
		{
			$csvData .= "Name(".$locale['name']."),";
			$csvData .= "Address(".$locale['name']."),";
			$csvData .= "Description(".$locale['name']."),";
			$csvData .= "Website(".$locale['name']."),";
			
		}
		$csvData .= "\n";
		header('Content-Type: text/csv; charset=utf-8');
		header("Content-Disposition: attachment; filename=organization-branches.csv");
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
			
			
			$this->AdminfunctionsPlugin()->validateduplicatelocale($tableName,$ID,$fieldName,$EDIT_ID,'organization_branch_id',$this->dbAdapter,$this->config);           
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
			
			if($this->memCached->hasItem('aula_organizationbranch_data') && is_array($this->memCached->getItem('aula_organizationbranch_data')))
			{
				$organization_branches = $this->memCached->getItem('aula_organizationbranch_data');
				$rowset[0] = $organization_branches[$iID];
			}
			else
			{
				$projectTable = new TableGateway('organization_branch', $this->dbAdapter);
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

            $projectTable = new TableGateway('organization_branch', $this->dbAdapter);
			$projectTableLocale = new TableGateway('organization_branch_locale', $this->dbAdapter);

            if ($this->request->getPost("pAction") == "DELETE") {
                $iMasterID = $this->request->getPost("KEY_ID");
				
				$projectTable->delete(array("id=".$iMasterID));
				$projectTableLocale->delete(array("organization_branch_id=".$iMasterID));
				$this->memCached->setItem('aula_organizationbranch_data','');
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
		$tableName = 'organization_branch';
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
				
				$updateData['is_main_branch'] 	= $this->setCheckboxValue($aData,'is_main_branch'.$iMasterID,'Yes','No');
				$updateData['published'] = $this->setCheckboxValue($aData,'published'.$iMasterID,'Yes','No');
				
				$projectTable->update($updateData,array("id=".$iMasterID));				
			}
			$this->memCached->setItem('aula_organizationbranch_data','');
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
		$tableName = 'organization_branch';
		$tableNameLocale = 'organization_branch_locale';
        if ($this->request->isPost()) {

            $projectTable = new TableGateway($tableName,$this->dbAdapter);
			$projectTableLocale = new TableGateway($tableNameLocale,$this->dbAdapter);
			
			$aData = json_decode($this->request->getPost("FORM_DATA"));
			$aData = (array)$aData;			
			
			$aData['published'] 		= $this->setCheckboxValue($aData,'published','Yes','No');
			$aData['is_main_branch'] 	= $this->setCheckboxValue($aData,'is_main_branch','Yes','No');

			if ($this->request->getPost("pAction") == "ADD")
			{
				$masterData = array();
				$masterData['mobile_number'] 	= $aData['mobile_number'];
				$masterData['mobile_number_2'] 	= $aData['mobile_number_2'];
				$masterData['phone_number'] 	= $aData['phone_number'];
				$masterData['fax'] 				= $aData['fax'];
				$masterData['country_id'] 		= $aData['country_id'];
				$masterData['city_id'] 			= $aData['city_id'];
				$masterData['manager_id'] 		= $aData['manager_id'];
				$masterData['work_days'] 		= $aData['work_days'];
				$masterData['work_hours'] 		= $aData['work_hours'];
				$masterData['break_hours'] 		= $aData['break_hours'];
				$masterData['geo_location'] 	= $aData['geo_location'];
				$masterData['is_main_branch'] 	= $aData['is_main_branch'];
				$masterData['published'] 		= $aData['published'];
				$masterData['organization_id']	= self::$Aula_OrgID;
				$masterData['owner_organization_id'] 		= self::$Aula_OwnerOrgID;
				$masterData['owner_organization_user_id'] 	= self::$Aula_OwnerOrgUserID;
				
				$projectTable->insert($masterData);	
				$iMasterID = $projectTable->lastInsertValue;	
				foreach($activeLocalesArray as $locale)
				{
					$detailData = array();
					$detailData['name'] 		= $aData['name_'.$locale['id']];
					$detailData['address'] 		= $aData['address_'.$locale['id']];
					$detailData['description']  = $aData['description_'.$locale['id']];
					$detailData['website'] 		= $aData['website_'.$locale['id']];
					$detailData['locale_id']    = $locale['id'];
					$detailData['organization_branch_id'] = $iMasterID;
					
					$detailData['organization_id'] 				= self::$Aula_OrgID;
					$detailData['owner_organization_id'] 		= self::$Aula_OwnerOrgID;
					$detailData['owner_organization_user_id'] 	= self::$Aula_OwnerOrgUserID;
				
					$projectTableLocale->insert($detailData);	
				}									
				$result['DBStatus'] = 'OK';
			}
			else  if($this->request->getPost("pAction") == "EDIT")
			{			
				$iMasterID=$aData['MASTER_KEY_ID'];				
				
				$masterData = array();
				$masterData['mobile_number'] 		= $aData['mobile_number'];
				$masterData['mobile_number_2'] 		= $aData['mobile_number_2'];
				$masterData['phone_number'] 		= $aData['phone_number'];
				$masterData['fax'] 					= $aData['fax'];
				$masterData['country_id'] 			= $aData['country_id'];
				$masterData['city_id'] 				= $aData['city_id'];
				$masterData['manager_id'] 			= $aData['manager_id'];
				$masterData['work_days'] 			= $aData['work_days'];
				$masterData['work_hours'] 			= $aData['work_hours'];
				$masterData['break_hours'] 			= $aData['break_hours'];
				$masterData['geo_location'] 		= $aData['geo_location'];
				$masterData['is_main_branch'] 		= $aData['is_main_branch'];
				$masterData['published'] 			= $aData['published'];
				$masterData['organization_id']		= self::$Aula_OrgID;
				
				$masterData['date_updated'] = date('Y-m-d H:i:s');
				
				$projectTable->update($masterData,array("id=".$iMasterID));
				foreach($activeLocalesArray as $locale)
				{
					$detailData = array();
					$detailData['name'] 		= $aData['name_'.$locale['id']];
					$detailData['address'] 		= $aData['address_'.$locale['id']];
					$detailData['description']  = $aData['description_'.$locale['id']];
					$detailData['website'] 		= $aData['website_'.$locale['id']];
					
					$rowset = $projectTableLocale->select(array("organization_branch_id=".$iMasterID,"locale_id=".$locale['id']));
					$rowset = $rowset->toArray();
					if(isset($rowset[0]['id']) && $rowset[0]['id'] > 0 ) 
					{					
						$detailData['date_updated'] = date('Y-m-d H:i:s');
						$projectTableLocale->update($detailData,array("id=".$rowset[0]['id']));						
					} 
					else 
					{
						$detailData['locale_id']    = $locale['id'];
						$detailData['organization_branch_id'] = $iMasterID;
						$detailData['organization_id'] 				= self::$Aula_OrgID;
						$detailData['owner_organization_id'] 		= self::$Aula_OwnerOrgID;
						$detailData['owner_organization_user_id'] 	= self::$Aula_OwnerOrgUserID;
						$projectTableLocale->insert($detailData);	
					}
					
				}									
				$result['DBStatus'] = 'OK';
			}
			$this->memCached->setItem('aula_organizationbranch_data','');
        }
        else
        {
            $result['DBStatus'] = 'ERR';
        }

        $result = json_encode($result);
        echo $result;
        exit;
    }
	public function getbranchAction() 
	  {                
		$sql="select organization_branch_id as id,name as name from view_organization_branch where 1=1 AND organization_id = '".self::$Aula_OrgID."' ";
		
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
