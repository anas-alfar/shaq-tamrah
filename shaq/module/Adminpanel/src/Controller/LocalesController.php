<?php
namespace Aula_Adminpanel\Controller;

use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Db\Sql\Sql as Sql;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Adapter\AdapterInterface;

class LocalesController extends AbstractActionController
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
		
		//$this->redisCache->flush();
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
		$aColumns = array( '`id`','`locale`','`name`','`locale_title`','`status`','`country_name`','`published`');
		if(!($this->memCached->hasItem('aula_locale_data')) || !is_array($this->memCached->getItem('aula_locale_data')))
		{	
			$sTable = 'view_locale';
		
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
			$this->memCached->setItem('aula_locale_data',$rowsetCache);
		}
			
		$rowset = $this->memCached->getItem('aula_locale_data');
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
	
	public function getorderlistAction()
	{
		$sTable = 'view_locale';
		$sIndexColumn = "id";  
		
		$sWhere = " WHERE 1=1";
		$sOrder = " ORDER BY sequence ASC ";		
		
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
		$draggable_list = '';
		$rowsetCache = array();
		foreach($rowset as $aRow)
		{			
			$draggable_list .= '<li class="list-group-item" id="'.$aRow['id'].'" draggable="true" role="option" aria-grabbed="false">
											
																								
													 <em class="fa fa-reorder fa-fw text-muted mr-lg"></em>		'.$aRow['name'].'						
											';
			$draggable_list .= '</li>';
		}
		/** Output **/
		$output = array(
			"status" => 'OK',
			"draggable_list" => $draggable_list
		);
		echo json_encode( $output ); 
		die();
	}
	public function saveorderAction()
	{	
		$projectTable = new TableGateway('locale',$this->dbAdapter);	 
        if ($this->request->isPost()) {		
			$aData =$this->request->getPost("dragorder");
			$orderRecordsArray =  explode(",",$aData);
			$sequence =0;	
			foreach($orderRecordsArray as $OrderID)
			{
				$sequence++;
				$updateData = array();
				$updateData['sequence'] = $sequence;
				$projectTable->update($updateData,array("id=".$OrderID));				
			}
			$this->memCached->setItem('aula_locale_data','');
			$result['DBStatus'] = 'OK';
		}
		else
        {
            $result['DBStatus'] = 'ERR';
        }	
        $output = array(
			"DBStatus" => 'OK'
		);
		echo json_encode( $output ); 
		die();
	}
	
	public function exportcsvAction()
	{
		if ($this->request->isPost()) 
		{
			$csvData = '';
			$sql = "SELECT * FROM view_locale WHERE 1 = 1";
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
			
			$csvData .= "#ID,Locale,Name,Locale Title,Published(Yes|No),Status(Draft|Pending|Active|Blocked|Deleted),Country,Icon";
			$csvData .= "\n";
			foreach($rowset as $row)
			{
				
				$csvData .= $row['id'].",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['locale']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['name']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['locale_title']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['published']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['status']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['country_name']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['icon']).",";
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
        $projectTable = new TableGateway('locale',$this->dbAdapter);
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
							if($data[1] != "" && $data[2] != "" && $data[3] != "" && $data[4] != "" && $data[5] != "" && $data[6] != "")
							{
								
							 	
								$saveDataArray = array();
								$column_index = 1;
								$saveDataArray['locale'] 			= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$saveDataArray['name'] 				= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$saveDataArray['locale_title'] 		= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$saveDataArray['published'] 		= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$getCountryID = $this->AdminfunctionsPlugin()->validateduplicateLocaleCSV('country_locale',$this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]),'name','country_id',$this->dbAdapter,$this->config['global_locale_id'],'locale_id');
								$saveDataArray['country_id']		= $getCountryID;
								$saveDataArray['icon'] 				= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								
								
								$existRecordID = $this->AdminfunctionsPlugin()->validateduplicateCSV('locale',$saveDataArray['locale'],'locale',$this->dbAdapter,$data[0]);  
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
									
									
									//$saveDataArray['organization_id'] = self::$Aula_OrgID;
									$saveDataArray['sequence'] = $this->AdminfunctionsPlugin()->getSequence("select sequence from locale order by sequence DESC LIMIT 1 ",$this->dbAdapter);
									$saveDataArray['owner_organization_id'] = self::$Aula_OwnerOrgID;
									$saveDataArray['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;								
									$projectTable->insert($saveDataArray);	
								}
							}
						}
						$result['status'] = 'OK';
						$result['message1'] = 'Csv imported successfully.';
						$this->memCached->setItem('aula_locale_data','');
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
	public function uploadimageAction()
    {
        $aData = (array)$aData;
		
        if ($this->request->isPost()) {

            $file = $_FILES['image'];
            $filename = $_FILES['image']['name'];
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
				$result['image'] = $filename;

            }

            //$data['logo_file']=$myImagePath_DB;
			//$_REQUEST['logohidden']=$myImagePath_DB;
            //$status=$projectTable->update($data,array('id' => ));


        }

        $result = json_encode($result);
        echo $result;
        exit;
    }
	public function downloadtemplateAction()
	{
		$csvData = '';		
		$csvData .= "#ID,Locale,Name,Locale Title,Published(Yes|No),Status(Draft|Pending|Active|Blocked|Deleted),Country,Icon";
		$csvData .= "\n";
		header('Content-Type: text/csv; charset=utf-8');
		header("Content-Disposition: attachment; filename=locales.csv");
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
			
			if($this->memCached->hasItem('aula_locale_data') && is_array($this->memCached->getItem('aula_locale_data')))
			{
				$locales = $this->memCached->getItem('aula_locale_data');
				$rowset[0] = $locales[$iID];
			}
			else
			{
				$projectTable = new TableGateway('locale', $this->dbAdapter);
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

            $projectTable = new TableGateway('locale', $this->dbAdapter);

            if ($this->request->getPost("pAction") == "DELETE") {
                $iMasterID = $this->request->getPost("KEY_ID");
				if($iMasterID !='1')
				{
					$projectTable->delete(array("id=".$iMasterID));
					$this->memCached->setItem('aula_locale_data','');
					$result['DBStatus'] = 'OK';
				}
				else
				{
					$result['DBStatus'] = 'Not Deleted';
				
				}
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
		$tableName = 'locale';
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
				//$updateData['force'] = $this->setCheckboxValue($aData,'force'.$iMasterID,'Yes','No');
				//$updateData['allow_override'] = $this->setCheckboxValue($aData,'allow_override'.$iMasterID,'Yes','No');
				$projectTable->update($updateData,array("id=".$iMasterID));				
			}
			$this->memCached->setItem('aula_locale_data','');
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
		$tableName = 'locale';
        if ($this->request->isPost()) {

            $projectTable = new TableGateway($tableName,$this->dbAdapter);
			
			$aData = json_decode($this->request->getPost("FORM_DATA"));
			$aData = (array)$aData;			
			
			//$aData['force'] = $this->setCheckboxValue($aData,'force','Yes','No');
			//$aData['allow_override'] = $this->setCheckboxValue($aData,'allow_override','Yes','No');
			$aData['published'] = $this->setCheckboxValue($aData,'published','Yes','No');

			if ($this->request->getPost("pAction") == "ADD")
			{	
				$sql="select sequence from locale order by sequence DESC LIMIT 1 ";
				
				$optionalParameters	= array();        
				$statement 			= $this->dbAdapter->createStatement($sql, $optionalParameters);        
				$resultData			= $statement->execute();        
				$resultSet 			= new ResultSet; 			   
				$resultSet->initialize($resultData);        
				$rowset 			= $resultSet->toArray();
				
				unset($aData['MASTER_KEY_ID']);	
				$aData['sequence'] 				 		= $rowset[0]['sequence']+1;
				//$aData['organization_id'] = self::$Aula_OrgID;
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
			$this->memCached->setItem('aula_locale_data','');
        }
        else
        {
            $result['DBStatus'] = 'ERR';
        }

        $result = json_encode($result);
        echo $result;
        exit;
    }
	public function getlocaleAction() 
	  {                
		$sql="select id as id,name as name from locale where published='Yes'";		        
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
