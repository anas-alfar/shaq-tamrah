<?php
namespace Aula_Adminpanel\Controller;

use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Db\Sql\Sql as Sql;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Adapter\AdapterInterface;

class AssetTypeController extends AbstractActionController
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
		$aColumns = array( '`id`','`id`','`name`','`published`','`country`',);
		if(!($this->memCached->hasItem('aula_asset_type_data')) || !is_array($this->memCached->getItem('aula_asset_type_data')))
		{	
			$sTable = 'view_asset_type';
		
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
					$sQuery_locale 		= "SELECT name,description FROM asset_type_locale WHERE locale_id = '".$locale['id']."' AND asset_type_id = '".$aRow['id']."' ";
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
			$this->memCached->setItem('aula_asset_type_data',$rowsetCache);
		}
			
		$rowset = $this->memCached->getItem('aula_asset_type_data');
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
		$asset_type = $this->AdminfunctionsPlugin()->getSingleRecord($iID,$this->memCached,'aula_asset_type_data','view_asset_type',$this->dbAdapter);
		$asset_type_storage_type_record = $this->AdminfunctionsPlugin()->getSingleRecord2('asset_type_id',$asset_type['asset_type_id'],'asset_type_storage_type',$this->dbAdapter);	
		$asset_storage_type_id = $asset_type_storage_type_record[0]['asset_storage_type_id'];
		
		$asset_storage_type = $this->AdminfunctionsPlugin()->getSingleRecord($asset_storage_type_id,$this->memCached,'aula_assetstorage_data','view_asset_storage_type',$this->dbAdapter);
		
		
		$grid_list .= '<h5 class="gridDetailSectionHeading">Asset Storage Type:</h5>';
		$grid_list .= '<table cellpadding="5" cellspacing="0" border="0" class="table table-hover table-condensed gridDetailTable" id="asset_type_detail_tbl">';
		$grid_list .= '<tr >
							<td>Name : </td>
							<td>'.$asset_storage_type['name'].'</td>
						</tr>';
		$grid_list .= '<tr >
							<td>Description : </td>
							<td>'.$asset_storage_type['description'].'</td>
						</tr>';
		$grid_list .= '<tr >
							<td>Country : </td>
							<td>'.$asset_storage_type['country_name'].'</td>
						</tr>';
		$grid_list .= '</table>';	
		
		$asset_type_unit_type_record = $this->AdminfunctionsPlugin()->getSingleRecord2('asset_type_id',$asset_type['asset_type_id'],'asset_type_unit_type',$this->dbAdapter);	
		$asset_unit_type_id = $asset_type_unit_type_record[0]['asset_unit_type_id'];
		
		$asset_unit_type = $this->AdminfunctionsPlugin()->getSingleRecord($asset_unit_type_id,$this->memCached,'aula_assetunittype_data','view_asset_unit_type',$this->dbAdapter);
		
		
		$grid_list .= '<h5 class="gridDetailSectionHeading">Asset Unit Type:</h5>';
		$grid_list .= '<table cellpadding="5" cellspacing="0" border="0" class="table table-hover table-condensed gridDetailTable" id="asset_type_detail_tbl">';
		$grid_list .= '<tr >
							<td>Name : </td>
							<td>'.$asset_unit_type['name'].'</td>
						</tr>';
		$grid_list .= '<tr >
							<td>Description : </td>
							<td>'.$asset_unit_type['description'].'</td>
						</tr>';
		$grid_list .= '<tr >
							<td>Country : </td>
							<td>'.$asset_unit_type['country_name'].'</td>
						</tr>';
		$grid_list .= '</table>';
		
		$asset_type_condition_record = $this->AdminfunctionsPlugin()->getSingleRecord2('asset_type_id',$asset_type['asset_type_id'],'asset_type_condition',$this->dbAdapter);	
		$asset_type_condition_id = $asset_type_condition_record[0]['asset_condition_id'];
		
		$asset_type_condition = $this->AdminfunctionsPlugin()->getSingleRecord($asset_type_condition_id,$this->memCached,'aula_assetcondition_data','view_asset_condition',$this->dbAdapter);
		
		
		$grid_list .= '<h5 class="gridDetailSectionHeading">Asset Condition Type:</h5>';
		$grid_list .= '<table cellpadding="5" cellspacing="0" border="0" class="table table-hover table-condensed gridDetailTable" id="asset_type_detail_tbl">';
		$grid_list .= '<tr >
							<td>Name : </td>
							<td>'.$asset_type_condition['name'].'</td>
						</tr>';
		$grid_list .= '<tr >
							<td>Description : </td>
							<td>'.$asset_type_condition['description'].'</td>
						</tr>';
		$grid_list .= '<tr >
							<td>Country : </td>
							<td>'.$asset_type_condition['country_name'].'</td>
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
			$activeLocalesArray = $this->AdminfunctionsPlugin()->getActiveLocales($this->dbAdapter);		
			
			$csvData = '';		
			$sql = "SELECT * FROM view_asset_type WHERE 1 = 1";
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
			$csvData .= "#ID,HasTax(Yes|No),Has Sku(Yes|No),Has Serial(Yes|No),Has Expiry Date(Yes|No),Published(Yes|No),Country,";
			foreach($activeLocalesArray as $locale)
			{
				$csvData .= "Name(".$locale['name']."),";
				$csvData .= "Description(".$locale['name']."),";
				
			}
			$csvData .= "\n";
				
			
			foreach($rowset as $row)
			{
				
				$csvData .= $row['id'].",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['has_tax']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['has_sku']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['has_serial']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['has_expiry_date']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['published']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['country']).",";
				
				foreach($activeLocalesArray as $locale)
					{
						$sQuery_locale1 		= "SELECT name,description FROM asset_type_locale WHERE locale_id = '".$locale['id']."' AND asset_type_id = '".$row['id']."' ";
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
        $projectTable = new TableGateway('asset_type',$this->dbAdapter);
		$projectTableLocale = new TableGateway('asset_type_locale',$this->dbAdapter);
		$projectStorageTable = new TableGateway('asset_type_storage_type',$this->dbAdapter);
		$projectUnitTable = new TableGateway('asset_type_unit_type',$this->dbAdapter);
		$projectConditionTable = new TableGateway('asset_type_condition',$this->dbAdapter);
		
		
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
						
							if($data[1] != "" && $data[2] != "" && $data[3] != ""&& $data[4] != ""&& $data[5] != ""&& $data[6] != ""&& $data[7] != "")
							{
							
								$saveDataArray = array();
								
								
								
								$column_index = 1;
							 	
								$saveDataArray['has_tax'] 				= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$saveDataArray['has_sku'] 				= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$saveDataArray['has_serial'] 			= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$saveDataArray['has_expiry_date'] 				= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$saveDataArray['published'] 				= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								
								$getCountryID = $this->AdminfunctionsPlugin()->validateduplicateLocaleCSV('country_locale',$this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]),'name','country_id',$this->dbAdapter,$this->config['global_locale_id'],'locale_id');
								$saveDataArray['country_id']			= $getCountryID;
								
								$saveStorageDataArray = array();
								$getStorageID = $this->AdminfunctionsPlugin()->validateduplicateLocaleCSV('asset_storage_type_locale',$this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]),'name','asset_storage_type_id',$this->dbAdapter,$this->config['global_locale_id'],'locale_id');
								$saveStorageDataArray['asset_storage_type_id']			= $getStorageID;
								
								$saveUnitDataArray = array();
								$getUnitID = $this->AdminfunctionsPlugin()->validateduplicateLocaleCSV('asset_unit_type_locale',$this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]),'name','asset_unit_type_id',$this->dbAdapter,$this->config['global_locale_id'],'locale_id');
								$saveUnitDataArray['asset_unit_type_id']			= $getUnitID;
								
								$saveConditionArray = array();
								$getConditionID = $this->AdminfunctionsPlugin()->validateduplicateLocaleCSV('asset_condition_locale',$this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]),'name','asset_condition_id',$this->dbAdapter,$this->config['global_locale_id'],'locale_id');
								$saveConditionArray['asset_condition_id']			= $getConditionID;
								
								
									
								$detailData = array();
								$detailData['name'] = $data[$column_index++];
								$detailData['description'] = $data[$column_index++];
								
								
							
								$fnameValPair = array();
								$fnameValPair['name ']=$detailData['name'.$locale['id']];
								$fnameValPair['country_id ']=$saveDataArray['country_id'];
								
								$existRecordID = $this->AdminfunctionsPlugin()->validateduplicatemultipleCSV('view_asset_type',$data[0],$fnameValPair,$this->dbAdapter);	
								
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
									$projectTableLocale->update($detailData,array("asset_type_id=".$existRecordID,"locale_id=".$this->config['global_locale_id']));	
								}
								else
								{
								echo "dfg3";
									
									$saveDataArray['owner_organization_id'] = self::$Aula_OwnerOrgID;
									$saveDataArray['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;
												print_r($saveDataArray);					
									$projectTable->insert($saveDataArray);	
									$existRecordID = $projectTable->lastInsertValue;
									
									$saveStorageDataArray['asset_type_id'] 						= $existRecordID;
									$saveStorageDataArray['owner_organization_id'] = self::$Aula_OwnerOrgID;
									$saveStorageDataArray['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;
									
									$projectStorageTable->insert($saveStorageDataArray);
									
									$saveUnitDataArray['asset_type_id'] 						= $existRecordID;
									$saveUnitDataArray['owner_organization_id'] = self::$Aula_OwnerOrgID;
									$saveUnitDataArray['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;
									
									$projectUnitTable->insert($saveUnitDataArray);
									
									$saveConditionArray['asset_type_id'] 						= $existRecordID;
									$saveConditionArray['owner_organization_id'] = self::$Aula_OwnerOrgID;
									$saveConditionArray['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;
									
									$projectConditionTable->insert($saveConditionArray);
									
									$detailData['owner_organization_id'] = self::$Aula_OwnerOrgID;
									$detailData['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;	
									$detailData['asset_type_id'] = $existRecordID;
									$detailData['locale_id'] = $this->config['global_locale_id'];							
									$projectTableLocale->insert($detailData);	
									
									
								}
								foreach($activeLocalesArray as $locale)
								{
									if($locale['id'] == $this->config['global_locale_id'])
										continue;
										
									$existLocaleRecordID = $this->AdminfunctionsPlugin()->validateduplicateLocaleCSV('asset_type_locale',$existRecordID,'asset_type_id','id',$this->dbAdapter,$locale['id'],'locale_id'); 
									
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
										$detailData['asset_type_id'] = $existRecordID;
										$detailData['locale_id'] = $locale['id'];							
										$projectTableLocale->insert($detailData);	
									}
								
								}
							}
						}
						$result['status'] = 'OK';
						$result['message1'] = 'Csv imported successfully.';
						$this->memCached->setItem('aula_asset_type_data','');
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
		
		$csvData .= "#ID,HasTax(Yes|No),Has Sku(Yes|No),Has Serial(Yes|No),Has Expiry Date(Yes|No),Published(Yes|No),Country,Asset Type Storage Types,Asset Type Unit Types,Asset Type Condition,";
		foreach($activeLocalesArray as $locale)
		{
				$csvData .= "Name(".$locale['name']."),";
				$csvData .= "Description(".$locale['name']."),";
			
		}
		$csvData .= "\n";
		header('Content-Type: text/csv; charset=utf-8');
		header("Content-Disposition: attachment; filename=asset_type.csv");
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
			
			if($this->memCached->hasItem('aula_asset_type_data') && is_array($this->memCached->getItem('aula_asset_type_data')))
			{
				$asset_type = $this->memCached->getItem('aula_asset_type_data');
				$rowset[0] = $asset_type[$iID];
				$asset_type_storage_type = $this->memCached->getItem('aula_asset_type_data');
				$rowset1[0] = $asset_type_storage_type[$iID];
				$asset_type_unit_type = $this->memCached->getItem('aula_asset_type_data');
				$rowset2[0] = $asset_type_unit_type[$iID];
				$asset_type_condition = $this->memCached->getItem('aula_asset_type_data');
				$rowset3[0] = $asset_type_condition[$iID];
				
			}
			else
			{
				$projectTable = new TableGateway('asset_type', $this->dbAdapter);
				$rowset = $projectTable->select(array('id' => $iID));
				$rowset = $rowset->toArray();
				
			}
				$projectTableStorage = new TableGateway('asset_type_storage_type', $this->dbAdapter);
				$rowset1 = $projectTableStorage->select(array('asset_type_id' => $iID));
				$rowset1 = $rowset1->toArray();
				$projectTableUnit = new TableGateway('asset_type_unit_type', $this->dbAdapter);
				$rowset2 = $projectTableUnit->select(array('asset_type_id' => $iID));
				$rowset2 = $rowset2->toArray();
				$projectTableCondition = new TableGateway('asset_type_condition', $this->dbAdapter);
				$rowset3 = $projectTableCondition->select(array('asset_type_id' => $iID));
				$rowset3 = $rowset3->toArray();
				
				
            foreach ($rowset as $record)
			{
			$record['asset_storage_type_id']=$rowset1[0]['asset_storage_type_id'];
			$record['asset_unit_type_id']=$rowset2[0]['asset_unit_type_id'];
			$record['asset_condition_id']=$rowset3[0]['asset_condition_id'];
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

            $projectTable = new TableGateway('asset_type', $this->dbAdapter);
			$projectTableLocale = new TableGateway('asset_type_locale', $this->dbAdapter);

            if ($this->request->getPost("pAction") == "DELETE") {
                $iMasterID = $this->request->getPost("KEY_ID");
				
				$projectTable->delete(array("id=".$iMasterID));
				$projectTableLocale->delete(array("asset_type_id=".$iMasterID));
				$this->memCached->setItem('aula_asset_type_data','');
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
		$tableName = 'asset_type';
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
			$this->memCached->setItem('aula_asset_type_data','');
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
		$tableName = 'asset_type';
		$tableNameLocale = 'asset_type_locale';
		$tableNameStorage = 'asset_type_storage_type';
		$tableNameUnit = 'asset_type_unit_type';
		$tableNameCondition = 'asset_type_condition';
        if ($this->request->isPost()) {

            $projectTable = new TableGateway($tableName,$this->dbAdapter);
			$projectTableLocale = new TableGateway($tableNameLocale,$this->dbAdapter);
			$projectTableStorage = new TableGateway($tableNameStorage,$this->dbAdapter);
			$projectTableUnit = new TableGateway($tableNameUnit,$this->dbAdapter);
			$projectTableCondition = new TableGateway($tableNameCondition,$this->dbAdapter);
			
			$aData = json_decode($this->request->getPost("FORM_DATA"));
			$aData = (array)$aData;			
			
			$aData['has_tax'] 					    = $this->setCheckboxValue($aData,'has_tax','Yes','No');
			$aData['has_sku']    		  			= $this->setCheckboxValue($aData,'has_sku','Yes','No');
			$aData['has_serial']		  = $this->setCheckboxValue($aData,'has_serial','Yes','No');
			$aData['has_expiry_date'] 	 	 	  = $this->setCheckboxValue($aData,'has_expiry_date','Yes','No');
			$aData['published'] 			  = $this->setCheckboxValue($aData,'published','Yes','No');
			
			if ($this->request->getPost("pAction") == "ADD")
			{
				$masterData = array();
				$masterData['has_tax'] 						= $aData['has_tax'];
				$masterData['has_sku'] 						= $aData['has_sku'];
				$masterData['has_serial'] 					= $aData['has_serial'];
				$masterData['has_expiry_date'] 				= $aData['has_expiry_date'];
				$masterData['published'] 					= $aData['published'];
				$masterData['country_id'] 					= $aData['country_id'];
						
				
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
					$detailData['asset_type_id'] = $iMasterID;
					
					$detailData['owner_organization_id'] = self::$Aula_OwnerOrgID;
					$detailData['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;
				
					$projectTableLocale->insert($detailData);	
				}
				$masterStorage = array();	
				$masterStorage['asset_type_id'] 						= $iMasterID;
				$masterStorage['asset_storage_type_id'] 						= $aData['asset_storage_type_id'];
				$masterStorage['owner_organization_id'] = self::$Aula_OwnerOrgID;
				$masterStorage['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;
				$projectTableStorage->insert($masterStorage);
				
				$masterUnit = array();
				$masterUnit['asset_type_id'] 						= $iMasterID;
				$masterUnit['asset_unit_type_id'] 						= $aData['asset_unit_type_id'];
				$masterUnit['owner_organization_id'] = self::$Aula_OwnerOrgID;
				$masterUnit['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;
				$projectTableUnit->insert($masterUnit);	
				
				$masterCondition = array();
				$masterCondition['asset_type_id'] 						= $iMasterID;
				$masterCondition['asset_condition_id'] 						= $aData['asset_condition_id'];
				$masterCondition['owner_organization_id'] = self::$Aula_OwnerOrgID;
				$masterCondition['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;
				$projectTableCondition->insert($masterCondition);	
				$result['DBStatus'] = 'OK';
			}
			else  if($this->request->getPost("pAction") == "EDIT")
			{			
				$iMasterID=$aData['MASTER_KEY_ID'];				
				
				$masterData = array();
				$masterData['has_tax'] 						= $aData['has_tax'];
				$masterData['has_sku'] 						= $aData['has_sku'];
				$masterData['has_serial'] 					= $aData['has_serial'];
				$masterData['has_expiry_date'] 				= $aData['has_expiry_date'];
				$masterData['published'] 					= $aData['published'];
				$masterData['country_id'] 					= $aData['country_id'];
				$masterData['date_updated'] 		= date('Y-m-d H:i:s');
				
				$projectTable->update($masterData,array("id=".$iMasterID));
				foreach($activeLocalesArray as $locale)
				{
					$detailData = array();
					$detailData['name'] = $aData['name_'.$locale['id']];
					$detailData['description'] = $aData['description_'.$locale['id']];
					
					$rowset = $projectTableLocale->select(array("asset_type_id=".$iMasterID,"locale_id=".$locale['id']));
					$rowset = $rowset->toArray();
					if(isset($rowset[0]['id']) && $rowset[0]['id'] > 0 ) 
					{					
						$detailData['date_updated'] = date('Y-m-d H:i:s');
						$projectTableLocale->update($detailData,array("id=".$rowset[0]['id']));						
					} 
					else 
					{
						$detailData['locale_id'] = $locale['id'];
						$detailData['asset_type_id'] = $iMasterID;
						$detailData['owner_organization_id'] = self::$Aula_OwnerOrgID;
						$detailData['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;
						$projectTableLocale->insert($detailData);	
					}
					
				}	
				
				$rowset = $projectTableStorage->select(array("asset_type_id=".$iMasterID));
				$rowset = $rowset->toArray();
				$masterStorage = array();	
				if(isset($rowset[0]['id']) && $rowset[0]['id'] > 0 ) 
				{
					$masterStorage['asset_type_id'] 						= $iMasterID;
					$masterStorage['asset_storage_type_id'] 						= $aData['asset_storage_type_id'];
					$masterStorage['owner_organization_id'] = self::$Aula_OwnerOrgID;
					$masterStorage['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;
					$masterStorage['date_updated'] 		= date('Y-m-d H:i:s');	
					$projectTableStorage->update($masterStorage,array("asset_type_id=".$iMasterID));
				}
				else
				{
					$masterStorage['asset_type_id'] 						= $iMasterID;
					$masterStorage['asset_storage_type_id'] 						= $aData['asset_storage_type_id'];
					$masterStorage['owner_organization_id'] = self::$Aula_OwnerOrgID;
					$masterStorage['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;
					
					$projectTableStorage->insert($masterStorage);
				
				}
				
				$rowset = $projectTableUnit->select(array("asset_type_id=".$iMasterID));
				$rowset = $rowset->toArray();
				$masterUnit = array();	
				if(isset($rowset[0]['id']) && $rowset[0]['id'] > 0 ) 
				{
					$masterUnit['asset_type_id'] 						= $iMasterID;
					$masterUnit['asset_unit_type_id'] 						= $aData['asset_unit_type_id'];
					$masterUnit['owner_organization_id'] = self::$Aula_OwnerOrgID;
					$masterUnit['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;
					$masterUnit['date_updated'] 		= date('Y-m-d H:i:s');	
					$projectTableUnit->update($masterUnit,array("asset_type_id=".$iMasterID));
				}
				else
				{
					$masterUnit['asset_type_id'] 						= $iMasterID;
					$masterUnit['asset_unit_type_id'] 						= $aData['asset_unit_type_id'];
					$masterUnit['owner_organization_id'] = self::$Aula_OwnerOrgID;
					$masterUnit['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;
					
					$projectTableUnit->insert($masterUnit);
				
				}
				
				$rowset = $projectTableCondition->select(array("asset_type_id=".$iMasterID));
				$rowset = $rowset->toArray();
				$masterCondition = array();	
				if(isset($rowset[0]['id']) && $rowset[0]['id'] > 0 ) 
				{
					$masterCondition['asset_type_id'] 						= $iMasterID;
					$masterCondition['asset_condition_id'] 						= $aData['asset_condition_id'];
					$masterCondition['owner_organization_id'] = self::$Aula_OwnerOrgID;
					$masterCondition['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;
					$masterCondition['date_updated'] 		= date('Y-m-d H:i:s');	
					$projectTableCondition->update($masterCondition,array("asset_type_id=".$iMasterID));
				}
				else
				{
					$masterCondition['asset_type_id'] 						= $iMasterID;
					$masterCondition['asset_condition_id'] 						= $aData['asset_condition_id'];
					$masterCondition['owner_organization_id'] = self::$Aula_OwnerOrgID;
					$masterCondition['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;
					
					$projectTableCondition->insert($masterCondition);
				
				}
				
											
				$result['DBStatus'] = 'OK';
			}
			$this->memCached->setItem('aula_asset_type_data','');
        }
        else
        {
            $result['DBStatus'] = 'ERR';
        }

        $result = json_encode($result);
        echo $result;
        exit;
    }
	public function getassettypeAction() 
	  {
	  	               
		$sql="select asset_type_id as id,name as name,published from view_asset_type where published='Yes' ";
		
		if ($this->request->getPost("country_id") !='' && $this->request->getPost("country_id") >= 0) 
		$sql .= " AND country_id = '".$this->request->getPost("country_id")."' ";
				       
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
