<?php
namespace Aula_Adminpanel\Controller;

use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Db\Sql\Sql as Sql;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Adapter\AdapterInterface;

class DonorController extends AbstractActionController
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
		$aColumns = array( '`id`','`first_name`','`ssn`','`title`','`gender`','`email`','`mobile_number`','`nationality`');
		if(!($this->memCached->hasItem('aula_donor_data')) || !is_array($this->memCached->getItem('aula_donor_data')))
		{	
			$sTable = 'view_donor';
		
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
					$sQuery_locale 		= "SELECT first_name,second_name,third_name,last_name,address FROM donor_locale WHERE locale_id = '".$locale['id']."' AND donor_id = '".$aRow['id']."' ";
					$statement_locale	= $this->dbAdapter->createStatement($sQuery_locale, $optionalParameters);        
					$resultData_locale	= $statement_locale->execute();        
					$resultSet_locale	= new ResultSet; 			   
					$resultSet_locale->initialize($resultData_locale);        
					$rowset_locale		= $resultSet_locale->toArray();
					$aRow['first_name_'.$locale['id']] = $rowset_locale[0]['first_name'];
					$aRow['second_name_'.$locale['id']] = $rowset_locale[0]['second_name'];
					$aRow['third_name_'.$locale['id']] = $rowset_locale[0]['third_name'];
					$aRow['last_name_'.$locale['id']] = $rowset_locale[0]['last_name'];
					$aRow['address_'.$locale['id']] = $rowset_locale[0]['address'];
				}
				$rowsetCache[$aRow['id']] = $aRow;
			}
			$this->memCached->setItem('aula_donor_data',$rowsetCache);
		}
			
		$rowset = $this->memCached->getItem('aula_donor_data');
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
			$sql = "SELECT * FROM view_donor WHERE 1 = 1";
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
			$csvData .= "#ID,Ssn,Title,Gender,Email,Date Of Birth,Mobile Number,Mobile Number 2,Phone Nnumber,Nationality Id,Avatar,Organization,Organization Branch,";
			foreach($activeLocalesArray as $locale)
			{
				$csvData .= "First Name(".$locale['name']."),";
				$csvData .= "Second Name(".$locale['name']."),";
				$csvData .= "Third Name(".$locale['name']."),";
				$csvData .= "Last Name(".$locale['name']."),";
				$csvData .= "Address(".$locale['name']."),";
				
			}
			$csvData .= "\n";
				
			
			foreach($rowset as $row)
			{
				
				$csvData .= $row['id'].",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['ssn']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['title']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['gender']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['email']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['date_of_birth']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate("M-".$row['mobile_number']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate("M-".$row['mobile_number_2']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate("P-".$row['phone_number']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['nationality_id']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['avatar']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['organization_branch']).",";
				foreach($activeLocalesArray as $locale)
					{
						$sQuery_locale1 		= "SELECT first_name,second_name,third_name,last_name,address FROM donor_locale WHERE locale_id = '".$locale['id']."' AND donor_id = '".$row['id']."' ";
						$statement_locale	= $this->dbAdapter->createStatement($sQuery_locale1, $optionalParameters);        
						$resultData_locale	= $statement_locale->execute();        
						$resultSet_locale	= new ResultSet; 			   
						$resultSet_locale->initialize($resultData_locale);        
						$rowset_locale		= $resultSet_locale->toArray();
						$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($rowset_locale[0]['first_name']).",";
						$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($rowset_locale[0]['second_name']).",";
						$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($rowset_locale[0]['third_name']).",";
						$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($rowset_locale[0]['last_name']).",";
						$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($rowset_locale[0]['address']).",";
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
        $projectTable = new TableGateway('donor',$this->dbAdapter);
		$projectTableLocale = new TableGateway('donor_locale',$this->dbAdapter);
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
							if($data[1] != "" && $data[2] != "" && $data[3] != "" && $data[4] != "" && $data[5] != "" &&$data[6] != ""&& $data[7] != ""&& $data[8] != ""&& $data[9] != "" &&$data[10] != ""&&$data[11] != ""&&$data[12] != ""&&$data[13] != ""&&$data[14] != ""&&$data[15] != ""&&$data[16] != ""&&$data[17] != ""&&$data[18] != "" )
							{
								$saveDataArray = array();
								$column_index = 1;
								$saveDataArray['ssn'] 	= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$saveDataArray['title'] 	= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$saveDataArray['gender'] 	= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$saveDataArray['email'] 	= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$saveDataArray['date_of_birth'] 	= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$saveDataArray['mobile_number'] 	= $this->AdminfunctionsPlugin()->importDataValidate(str_replace("M-", "",$data[$column_index++]));
								$saveDataArray['mobile_number_2'] 	= $this->AdminfunctionsPlugin()->importDataValidate(str_replace("M-", "",$data[$column_index++]));
								$saveDataArray['phone_number'] 	= $this->AdminfunctionsPlugin()->importDataValidate(str_replace("P-", "",$data[$column_index++]));
								$saveDataArray['nationality_id'] 	= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$saveDataArray['avatar'] 	= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								
								
								
								$getOrgBranchID = $this->AdminfunctionsPlugin()->validateduplicateLocaleCSV('organization_branch_locale',$this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]),'name','organization_branch_id',$this->dbAdapter,$this->config['global_locale_id'],'locale_id');
								$saveDataArray['organization_branch_id'] 	= $getOrgBranchID;
								
								
								$detailData = array();
								$detailData['first_name'] 	= $data[$column_index++];
								$detailData['second_name'] 	= $data[$column_index++];
								$detailData['third_name'] 		= $data[$column_index++];
								$detailData['last_name'] 		= $data[$column_index++];
								$detailData['address'] 		= $data[$column_index++];
									
								
								$existRecordID = $data[0]; 
								if($existRecordID > 0)
								{
									$saveDataArray['date_updated'] = date('Y-m-d H:i:s');		
									$projectTable->update($saveDataArray,array("id=".$existRecordID));
									
									$detailData['date_updated'] = date('Y-m-d H:i:s');
									$projectTableLocale->update($detailData,array("donor_id=".$existRecordID,"locale_id=".$this->config['global_locale_id']));	
								}
								else
								{
									$existRecordID = $this->AdminfunctionsPlugin()->validateduplicateCSV('view_donor',$saveDataArray['ssn'],'ssn',$this->dbAdapter);	
									if($existRecordID > 0)
									{
										continue;
									}
									$saveDataArray['organization_id'] = self::$Aula_OrgID;
									$saveDataArray['owner_organization_id'] = self::$Aula_OwnerOrgID;
									$saveDataArray['owner_donor_id'] = self::$Aula_OwnerOrgUserID;								
									$projectTable->insert($saveDataArray);	
									$existRecordID = $projectTable->lastInsertValue;	
									
									$detailData['organization_id'] = self::$Aula_OrgID;
									$detailData['owner_organization_id'] = self::$Aula_OwnerOrgID;
									$detailData['owner_donor_id'] = self::$Aula_OwnerOrgUserID;	
									$detailData['donor_id'] = $existRecordID;
									$detailData['locale_id'] = $this->config['global_locale_id'];							
									$projectTableLocale->insert($detailData);	
								}
								foreach($activeLocalesArray as $locale)
								{
									if($locale['id'] == $this->config['global_locale_id'])
										continue;
										
									
									$detailData = array();
									$detailData['first_name'] 	= $data[$column_index++];
									$detailData['second_name'] 	= $data[$column_index++];
									$detailData['third_name'] 		= $data[$column_index++];
									$detailData['last_name'] 		= $data[$column_index++];
									$detailData['address'] 		= $data[$column_index++];
									
									if($existRecordID > 0)
									{										
										$detailData['date_updated'] = date('Y-m-d H:i:s');
										$projectTableLocale->update($detailData,array("locale_id=".$locale[id],"donor_id=".$existRecordID));
									}
									else
									{	$detailData['organization_id'] = self::$Aula_OrgID;								
										$detailData['owner_organization_id'] = self::$Aula_OwnerOrgID;
										$detailData['owner_donor_id'] = self::$Aula_OwnerOrgUserID;	
										$detailData['donor_id'] = $existRecordID;
										$detailData['locale_id'] = $locale['id'];	
										
		print_r($detailData);						
										$projectTableLocale->insert($detailData);	
									}
								
								}
							}
						}
						$result['status'] = 'OK';
						$result['message1'] = 'Csv imported successfully.';
						$this->memCached->setItem('aula_donor_data','');
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
		
		$csvData .= "#ID,Ssn,Title,Gender,Email,Date Of Birth,Mobile Number,Mobile Number 2,Phone Nnumber,Nationality Id,Avatar,Organization Branch,";
		foreach($activeLocalesArray as $locale)
		{
			$csvData .= "First Name(".$locale['name']."),";
			$csvData .= "Second Name(".$locale['name']."),";
			$csvData .= "Third Name(".$locale['name']."),";
			$csvData .= "Last Name(".$locale['name']."),";
			$csvData .= "Address(".$locale['name']."),";
			
		}
		$csvData .= "\n";
		header('Content-Type: text/csv; charset=utf-8');
		header("Content-Disposition: attachment; filename=organization-users.csv");
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
		
			$this->AdminfunctionsPlugin()->validateduplicatelocale($tableName,$ID,$fieldName,$EDIT_ID,'donor_id',$this->dbAdapter,$this->config);           
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
			
			if($this->memCached->hasItem('aula_donor_data') && is_array($this->memCached->getItem('aula_donor_data')))
			{
				$menu_item = $this->memCached->getItem('aula_donor_data');
				$rowset[0] = $menu_item[$iID];
			}
			else
			{
				$projectTable = new TableGateway('donor', $this->dbAdapter);
				$rowset = $projectTable->select(array('id' => $iID));
				$rowset = $rowset->toArray();
			}

            foreach ($rowset as $record)
			{
				foreach($activeLocalesArray as $locale)
				{
					
					$sQuery_locale 		= "SELECT first_name,second_name,third_name,last_name,address FROM donor_locale WHERE locale_id = '".$locale['id']."' AND donor_id = '".$record['id']."' ";
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
	
	public function  deleteAction()
    {
        
        if ($this->request->isPost()) {

            $projectTable = new TableGateway('donor', $this->dbAdapter);
			$projectTableLocale = new TableGateway('donor_locale', $this->dbAdapter);

            if ($this->request->getPost("pAction") == "DELETE") {
                $iMasterID = $this->request->getPost("KEY_ID");
				
				$projectTable->delete(array("id=".$iMasterID));
				$projectTableLocale->delete(array("donor_id=".$iMasterID));
				$this->memCached->setItem('aula_donor_data','');
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
	public function uploadavatarAction()
    {
        $aData = (array)$aData;
		
        if ($this->request->isPost()) {

            $file = $_FILES['avatar'];
            $filename = $_FILES['avatar']['name'];
			$filename = rand(0,999).$filename;
			$myImagePath =  $this->config['site_dir_path']['public_dir_path']."uploads/localeicons/".$filename;
			$size=$_FILES['media']['size'];
            if (!move_uploaded_file($file['tmp_name'], $myImagePath)) {
                $result['status'] = 'ERR';
                $result['message1'] = 'Unable to save file![signature]';
            } else {
                $result['status'] = 'OK';
                $result['message1'] = 'Done';				
				$result['avatar'] = $filename;

            }
        }

        $result = json_encode($result);
        echo $result;
        exit;
    }

    public function saveAction()
    { 
		$activeLocalesArray = $this->AdminfunctionsPlugin()->getActiveLocales($this->dbAdapter);       
		$tableName = 'donor';
		$tableNameLocale = 'donor_locale';
        if ($this->request->isPost()) {

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

			if ($this->request->getPost("pAction") == "ADD")
			{
				$sql="select sequence from donor order by sequence DESC LIMIT 1 ";
				
				$optionalParameters	= array();        
				$statement 			= $this->dbAdapter->createStatement($sql, $optionalParameters);        
				$resultData			= $statement->execute();        
				$resultSet 			= new ResultSet; 			   
				$resultSet->initialize($resultData);        
				$rowset 			= $resultSet->toArray();
				
				$masterData = array();
				$avatar=$aData['avatarhidden'];
				unset($aData['avatarhidden']);
				$masterData['sequence'] 				= $rowset[0]['sequence']+1;
				$masterData['ssn'] 						= $aData['ssn'];
				$masterData['title'] 					= $aData['title'];
				$masterData['gender'] 					= $aData['gender'];
				$masterData['email'] 					= $aData['email'];
				$masterData['date_of_birth'] 			= $aData['date_of_birth'];
				$masterData['mobile_number'] 			= $aData['mobile_number'];
				$masterData['mobile_number_2'] 			= $aData['mobile_number_2'];
				$masterData['phone_number'] 			= $aData['phone_number'];
				$masterData['notes'] 					= $aData['notes'];
				$masterData['options'] 					= $aData['options'];
				$masterData['nationality_id'] 			= $aData['nationality_id'];
				if($avatar != "")
				{
					$masterData['avatar']=$avatar;
				}
				$masterData['visibility'] 	= $aData['visibility'];
				
				
				$masterData['owner_organization_id'] = self::$Aula_OwnerOrgID;
				$masterData['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;
				
				
				
				$projectTable->insert($masterData);	
				$iMasterID = $projectTable->lastInsertValue;	
				foreach($activeLocalesArray as $locale)
				{
					$detailData = array();
					$detailData['first_name'] 		= $aData['first_name_'.$locale['id']];
					$detailData['second_name'] 		= $aData['second_name_'.$locale['id']];
					$detailData['third_name'] 		= $aData['third_name_'.$locale['id']];
					$detailData['last_name'] 		= $aData['last_name_'.$locale['id']];
					$detailData['address'] 			= $aData['address_'.$locale['id']];
					$detailData['locale_id'] 		= $locale['id'];
					$detailData['donor_id'] = $iMasterID;
					
					
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
				$masterData['ssn'] 						= $aData['ssn'];
				$masterData['title'] 					= $aData['title'];
				$masterData['gender'] 					= $aData['gender'];
				$masterData['email'] 					= $aData['email'];
				$masterData['date_of_birth'] 			= $aData['date_of_birth'];
				$masterData['mobile_number'] 			= $aData['mobile_number'];
				$masterData['mobile_number_2'] 			= $aData['mobile_number_2'];
				$masterData['phone_number'] 			= $aData['phone_number'];
				$masterData['notes'] 					= $aData['notes'];
				$masterData['options'] 					= $aData['options'];
				$masterData['nationality_id'] 			= $aData['nationality_id'];
				if($avatar != "")
				{
					$masterData['avatar']=$avatar;
				}
				$masterData['visibility'] 	= $aData['visibility'];
				$masterData['date_updated'] 		= date('Y-m-d H:i:s');
				
				$projectTable->update($masterData,array("id=".$iMasterID));
				foreach($activeLocalesArray as $locale)
				{
					$detailData = array();
					$detailData['first_name'] 		= $aData['first_name_'.$locale['id']];
					$detailData['second_name'] 		= $aData['second_name_'.$locale['id']];
					$detailData['third_name'] 		= $aData['third_name_'.$locale['id']];
					$detailData['last_name'] 		= $aData['last_name_'.$locale['id']];
					$detailData['address'] 			= $aData['address_'.$locale['id']];
					$detailData['date_updated'] = date('Y-m-d H:i:s');
					
					$projectTableLocale->update($detailData,array("donor_id=".$iMasterID,"locale_id=".$locale['id']));
				}									
				$result['DBStatus'] = 'OK';
			}
			$this->memCached->setItem('aula_donor_data','');
        }
        else
        {
            $result['DBStatus'] = 'ERR';
        }

        $result = json_encode($result);
        echo $result;
        exit;
    }
	public function savedonorAction()
    { 
		$activeLocalesArray = $this->AdminfunctionsPlugin()->getActiveLocales($this->dbAdapter);       
		$tableName = 'donor';
		$tableNameLocale = 'donor_locale';
        if ($this->request->isPost()) {

            $projectTable = new TableGateway($tableName,$this->dbAdapter);
			$projectTableLocale = new TableGateway($tableNameLocale,$this->dbAdapter);
			
			$aData = json_decode($this->request->getPost("FORM_DATA"));
			$aData = (array)$aData;			
			if($aData['date_of_birth1'] != '') {
				$date_of_birth_ar = explode("/",$aData['date_of_birth1']);
				$date_of_birth = $date_of_birth_ar[2].'-'.$date_of_birth_ar[0].'-'.$date_of_birth_ar[1];
				$aData['date_of_birth1'] = $date_of_birth;
			}
			else {
				unset($aData['date_of_birth1']);
			}

			
			$sql="select sequence from donor order by sequence DESC LIMIT 1 ";
			
			$optionalParameters	= array();        
			$statement 			= $this->dbAdapter->createStatement($sql, $optionalParameters);        
			$resultData			= $statement->execute();        
			$resultSet 			= new ResultSet; 			   
			$resultSet->initialize($resultData);        
			$rowset 			= $resultSet->toArray();
			
			$masterData = array();
			$avatar=$aData['avatarhidden'];
			unset($aData['avatarhidden']);
			$masterData['sequence'] 				= $rowset[0]['sequence']+1;
			$masterData['ssn'] 						= $aData['ssn'];
			$masterData['title'] 					= $aData['title'];
			$masterData['gender'] 					= $aData['gender'];
			$masterData['email'] 					= $aData['email'];
			$masterData['date_of_birth'] 			= $aData['date_of_birth1'];
			$masterData['mobile_number'] 			= $aData['mobile_number'];
			$masterData['mobile_number_2'] 			= $aData['mobile_number_2'];
			$masterData['phone_number'] 			= $aData['phone_number'];
			$masterData['notes'] 					= $aData['notes'];
			$masterData['options'] 					= $aData['options'];
			$masterData['nationality_id'] 			= $aData['nationality_id'];
			if($avatar != "")
			{
				$masterData['avatar']				= $avatar;
			}
			$masterData['visibility'] 				= $aData['visibility'];
			$masterData['owner_organization_id'] 	= self::$Aula_OwnerOrgID;
			$masterData['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;
			
			
			
			$projectTable->insert($masterData);	
			$iMasterID = $projectTable->lastInsertValue;	
			foreach($activeLocalesArray as $locale)
			{
				$detailData = array();
				$detailData['first_name'] 					= $aData['first_name_'.$locale['id']];
				$detailData['second_name'] 					= $aData['second_name_'.$locale['id']];
				$detailData['third_name'] 					= $aData['third_name_'.$locale['id']];
				$detailData['last_name'] 					= $aData['last_name_'.$locale['id']];
				$detailData['address'] 						= $aData['address_'.$locale['id']];
				$detailData['locale_id'] 					= $locale['id'];
				$detailData['donor_id'] 					= $iMasterID;
				$detailData['owner_organization_id'] 	  	= self::$Aula_OwnerOrgID;
				$detailData['owner_organization_user_id'] 	= self::$Aula_OwnerOrgUserID;
			 
				$projectTableLocale->insert($detailData);	
				$projectTableLocale->lastInsertValue;
			}									
			$result['DBStatus'] = 'OK';
			$this->memCached->setItem('aula_donor_data','');
        }
        else
        {
            $result['DBStatus'] = 'ERR';
        }

        $result = json_encode($result);
        echo $result;
        exit;
    }
	
	public function getdonorAction() 
	  {                
		$sql="select id as id,first_name as name from view_donor where 1=1";		        
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
