<?php
namespace Aula_Adminpanel\Controller;

use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Db\Sql\Sql as Sql;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Adapter\AdapterInterface;

class BranchCommitteeUserController extends AbstractActionController
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
		
		$aColumns = array( '`id`','`id`','`organization_user_position`','`organization_branch_name`','`organization_branch_committee`');
		if(!($this->memCached->hasItem('aula_branchcommitteeuser_data')) || !is_array($this->memCached->getItem('aula_branchcommitteeuser_data')))
		{	
			$sTable = 'view_organization_branch_committee_user';
		
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
			$this->memCached->setItem('aula_branchcommitteeuser_data',$rowsetCache);
		}
			
		$rowset = $this->memCached->getItem('aula_branchcommitteeuser_data');
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
		$committee = $this->AdminfunctionsPlugin()->getSingleRecord($iID,$this->memCached,'aula_branchcommitteeuser_data','view_organization_branch_committee_user',$this->dbAdapter);
		
		$committee_user = $this->AdminfunctionsPlugin()->getSingleRecord($committee['id'],$this->memCached,'aula_branchcommitteeuser_data','view_organization_branch_committee_user',$this->dbAdapter);	
		
		$grid_list = '';
		$grid_list .= '<h5 class="gridDetailSectionHeading">Committee User:</h5>';
		$grid_list .= '<table cellpadding="5" cellspacing="0" border="0" class="table table-hover table-condensed gridDetailTable" id="asset_type_detail_tbl">';
		$grid_list .= '<tr >
							<td>Name : </td>
							<td>'.$committee_user['organization_branch_name'].'</td>
						</tr>';
		$grid_list .= '<tr >
							<td>Position : </td>
							<td>'.$committee_user['organization_user_position'].'</td>
						</tr>';
		
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
		
			$csvData = '';
			$sql = "SELECT * FROM view_organization_branch_committee_user WHERE 1 = 1";	
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
			
			$csvData .= "#ID,Organization User,Organization User Position,Organization Branch,Organization Branch Committee";
			$csvData .= "\n";
			foreach($rowset as $row)
			{
				$csvData .= $row['id'].",";
				
				
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['organization_user_position']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['organization_branch_name']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['organization_branch_committee']).",";
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
        $projectTable = new TableGateway('organization_branch_committee_user',$this->dbAdapter);
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
							if($data[1] != "" && $data[2] != "" && $data[3] != "" && $data[4] != "")
							{
							 
								$saveDataArray = array();
								$column_index = 1;
								
								
								
								
								$getPositionID = $this->AdminfunctionsPlugin()->validateduplicateLocaleCSV('organization_user_position_locale',$this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]),'title','organization_user_position_id',$this->dbAdapter,$this->config['global_locale_id'],'locale_id');
								$saveDataArray['organization_user_position_id'] 	= $getPositionID;
								
								$getBranchID = $this->AdminfunctionsPlugin()->validateduplicateLocaleCSV('organization_branch_locale',$this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]),'name','organization_branch_id',$this->dbAdapter,$this->config['global_locale_id'],'locale_id');
								$saveDataArray['organization_branch_id']= $getBranchID;
								
								$getCommitteeID = $this->AdminfunctionsPlugin()->validateduplicateLocaleCSV('organization_branch_committee_locale',$this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]),'name','organization_branch_committee_id',$this->dbAdapter,$this->config['global_locale_id'],'locale_id');
								$saveDataArray['organization_branch_committee_id']= $getCommitteeID;
								
								
								$existRecordID = $this->AdminfunctionsPlugin()->validateduplicateCSV('organization_branch_committee_user',$saveDataArray['organization_id'],'organization_id',$this->dbAdapter,$data[0]);  
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
									
									$saveDataArray['organization_user_id'] 	= self::$Aula_UID;
									$saveDataArray['organization_user_position_id'] 	= $getPositionID;
									$saveDataArray['organization_branch_id']= $getBranchID;
									$saveDataArray['organization_branch_committee_id']= $getCommitteeID;
									$saveDataArray['owner_organization_id'] = self::$Aula_OwnerOrgID;
									$saveDataArray['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;								
									$projectTable->insert($saveDataArray);	
								}
							}
						}
						$result['status'] = 'OK';
						$result['message1'] = 'Csv imported successfully.';
						$this->memCached->setItem('aula_branchcommitteeuser_data','');
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
		$csvData .= "#ID,Organization User,Organization User Position,Organization Branch,Organization Branch Committee";
		$csvData .= "\n";
		header('Content-Type: text/csv; charset=utf-8');
		header("Content-Disposition: attachment; filename=organization_branch_committee_users.csv");
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
			
			if($this->memCached->hasItem('aula_branchcommitteeuser_data') && is_array($this->memCached->getItem('aula_branchcommitteeuser_data')))
			{
				$organization_branch_committee_users = $this->memCached->getItem('aula_branchcommitteeuser_data');
				$rowset[0] = $organization_branch_committee_users[$iID];
			}
			else
			{
				$projectTable = new TableGateway('organization_branch_committee_user', $this->dbAdapter);
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

            $projectTable = new TableGateway('organization_branch_committee_user', $this->dbAdapter);

            if ($this->request->getPost("pAction") == "DELETE") {
                $iMasterID = $this->request->getPost("KEY_ID");
				
				$projectTable->delete(array("id=".$iMasterID));
				$this->memCached->setItem('aula_branchcommitteeuser_data','');
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
		$tableName = 'organization_branch_committee_user';
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
				$updateData['force'] = $this->setCheckboxValue($aData,'force'.$iMasterID,'Yes','No');
				$updateData['allow_override'] = $this->setCheckboxValue($aData,'allow_override'.$iMasterID,'Yes','No');
				$projectTable->update($updateData,array("id=".$iMasterID));				
			}
			$this->memCached->setItem('aula_branchcommitteeuser_data','');
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
		$tableName = 'organization_branch_committee_user';
        if ($this->request->isPost()) {

            $projectTable = new TableGateway($tableName,$this->dbAdapter);
			
			$aData = json_decode($this->request->getPost("FORM_DATA"));
			$aData = (array)$aData;			
			
			if ($this->request->getPost("pAction") == "ADD")
			{	
				unset($aData['MASTER_KEY_ID']);			
				$masterData['organization_id']								 = self::$Aula_OrgID;
				$masterData['organization_user_id'] 					     = self::$Aula_UID;
				$masterData['organization_user_position_id']				 = $aData['organization_user_position_id'];
				$masterData['organization_branch_id'] 		 				 = $aData['organization_branch_id'];
				$masterData['organization_branch_committee_id'] 		     = $aData['organization_branch_committee_id'];				
				$aData['owner_organization_id'] 							 = self::$Aula_OwnerOrgID;
				$aData['owner_organization_user_id'] 						 = self::$Aula_OwnerOrgUserID;
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
			$this->memCached->setItem('aula_branchcommitteeuser_data','');
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
