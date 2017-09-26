<?php
namespace Aula_Adminpanel\Controller;

use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Db\Sql\Sql as Sql;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Adapter\AdapterInterface;

class AssetController extends AbstractActionController
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
		$aColumns = array( '`id`','`id`','`name`','`asset_type`','`cost`','`tax_type`','`tax_value`','`currency_name`','`currency_exchange_rate`','`country`','`published`','`asset_type_id`');
		if(!($this->memCached->hasItem('aula_asset_data')) || !is_array($this->memCached->getItem('aula_asset_data')))
		{	
			$sTable = 'view_asset';
		
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
					$sQuery_locale 		= "SELECT name,description,photo FROM asset_locale WHERE locale_id = '".$locale['id']."' AND asset_id = '".$aRow['id']."' ";
					$statement_locale	= $this->dbAdapter->createStatement($sQuery_locale, $optionalParameters);        
					$resultData_locale	= $statement_locale->execute();        
					$resultSet_locale	= new ResultSet; 			   
					$resultSet_locale->initialize($resultData_locale);        
					$rowset_locale		= $resultSet_locale->toArray();
					$aRow['name_'.$locale['id']] = $rowset_locale[0]['name'];
					$aRow['description_'.$locale['id']] = $rowset_locale[0]['description'];
					$aRow['photo_'.$locale['id']] = $rowset_locale[0]['photo'];
				}
				$rowsetCache[$aRow['id']] = $aRow;
			}
			$this->memCached->setItem('aula_asset_data',$rowsetCache);
		}
			
		$rowset = $this->memCached->getItem('aula_asset_data');
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
		$asset = $this->AdminfunctionsPlugin()->getSingleRecord($iID,$this->memCached,'aula_asset_data','view_asset',$this->dbAdapter);		
		$asset_type = $this->AdminfunctionsPlugin()->getSingleRecord($asset['asset_type_id'],$this->memCached,'aula_asset_type_data','view_asset_type',$this->dbAdapter);			
		
		$grid_list = '';
		$grid_list .= '<h5 class="gridDetailSectionHeading">Asset Type:</h5>';
		$grid_list .= '<table cellpadding="5" cellspacing="0" border="0" class="table table-hover table-condensed gridDetailTable" id="asset_type_detail_tbl">';
		$grid_list .= '<tr >
							<td>Name : </td>
							<td>'.$asset_type['name'].'</td>
						</tr>';
		$grid_list .= '<tr >
							<td>Description : </td>
							<td>'.$asset_type['description'].'</td>
						</tr>';
		$grid_list .= '<tr >
							<td>Country : </td>
							<td>'.$asset_type['country'].'</td>
						</tr>';
		$grid_list .= '</table>';
		
		
		$asset_type_storage_type_record = $this->AdminfunctionsPlugin()->getSingleRecord2('asset_type_id',$asset['asset_type_id'],'asset_type_storage_type',$this->dbAdapter);	
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
		
		$asset_type_unit_type_record = $this->AdminfunctionsPlugin()->getSingleRecord2('asset_type_id',$asset['asset_type_id'],'asset_type_unit_type',$this->dbAdapter);	
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
		
		$asset_type_condition_record = $this->AdminfunctionsPlugin()->getSingleRecord2('asset_type_id',$asset['asset_type_id'],'asset_type_condition',$this->dbAdapter);	
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
			$sql = "SELECT * FROM view_asset WHERE 1 = 1";
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
			$csvData .= "#ID,Asset Type,Cost,Tax Type,Tax Value,Currency,Currency Eexchange Rate,Published(Yes|No),Country,";
			foreach($activeLocalesArray as $locale)
			{
				$csvData .= "Name(".$locale['name']."),";
				$csvData .= "Description(".$locale['name']."),";
							
			}
			$csvData .= "\n";
				
			
			foreach($rowset as $row)
			{
				
				$csvData .= $row['id'].",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['asset_type']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['cost']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['tax_type']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['tax_value']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['currency_name']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['currency_exchange_rate']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['published']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['country']).",";
				foreach($activeLocalesArray as $locale)
					{
						$sQuery_locale1 		= "SELECT name,description,photo FROM asset_locale WHERE locale_id = '".$locale['id']."' AND asset_id = '".$row['id']."' ";
						$statement_locale	= $this->dbAdapter->createStatement($sQuery_locale1, $optionalParameters);        
						$resultData_locale	= $statement_locale->execute();        
						$resultSet_locale	= new ResultSet; 			   
						$resultSet_locale->initialize($resultData_locale);        
						$rowset_locale		= $resultSet_locale->toArray();
						$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($rowset_locale[0]['name']).",";
						$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($rowset_locale[0]['description']).",";
						$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($rowset_locale[0]['photo']).",";
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
        $projectTable = new TableGateway('asset',$this->dbAdapter);
		$projectTableLocale = new TableGateway('asset_locale',$this->dbAdapter);
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
							if($data[1] != "" && $data[2] != "" && $data[3] != "" && $data[4] != "" && $data[5] != "" && $data[6] != "" && $data[7] != "" && $data[8] != "" && $data[9] != "" )
							{
								$saveDataArray = array();
								$column_index = 1;
								$getAssetID = $this->AdminfunctionsPlugin()->validateduplicateLocaleCSV('asset_type_locale',$this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]),'name','asset_type_id',$this->dbAdapter,$this->config['global_locale_id'],'locale_id');
								$saveDataArray['asset_type_id']= $getAssetID;
								
								
								$saveDataArray['cost'] 		= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$saveDataArray['tax_type'] 		= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$saveDataArray['tax_value'] 		= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								
								
								$getCurrencyID = $this->AdminfunctionsPlugin()->validateduplicateCSV('currency',$this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]),'currency',$this->dbAdapter);
								$saveDataArray['currency'] 	= $getCurrencyID;
								
								$getexchangerateID = $this->AdminfunctionsPlugin()->validateduplicateCSV('currency_exchange_rate',$this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]),'exchange_rate',$this->dbAdapter);
								$saveDataArray['currency_exchange_rate_id'] 	= $getexchangerateID;
								
								$saveDataArray['published'] 		= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
																
								$getCountryID = $this->AdminfunctionsPlugin()->validateduplicateLocaleCSV('country_locale',$this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]),'name','country_id',$this->dbAdapter,$this->config['global_locale_id'],'locale_id');
								$saveDataArray['country_id']= $getCountryID;
								
								$detailData = array();
								$detailData['name'] = $data[$column_index++];
								$detailData['description'] = $data[$column_index++];
															
								$existRecordID = $this->AdminfunctionsPlugin()->validateduplicateCSV('view_asset',$detailData['name'],'name',$this->dbAdapter,$data[0]);	
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
									$projectTableLocale->update($detailData,array("asset_id=".$existRecordID,"locale_id=".$this->config['global_locale_id']));	
								}
								else
								{
									
									$saveDataArray['currency'] 	= $getCurrencyID;
									$saveDataArray['currency_exchange_rate_id'] 	= $getexchangerateID;
									$saveDataArray['country_id']= $getCountryID;
									$saveDataArray['owner_organization_id'] = self::$Aula_OwnerOrgID;
									$saveDataArray['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;								
									$projectTable->insert($saveDataArray);	
									$existRecordID = $projectTable->lastInsertValue;	
									
									$detailData['owner_organization_id'] = self::$Aula_OwnerOrgID;
									$detailData['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;	
									$detailData['asset_id'] = $existRecordID;
									$detailData['locale_id'] = $this->config['global_locale_id'];							
									$projectTableLocale->insert($detailData);	
								}
								foreach($activeLocalesArray as $locale)
								{
									if($locale['id'] == $this->config['global_locale_id'])
										continue;
										
									$existLocaleRecordID = $this->AdminfunctionsPlugin()->validateduplicateLocaleCSV('asset_locale',$existRecordID,'asset_id','id',$this->dbAdapter,$locale['id'],'locale_id'); 
									
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
										$detailData['asset_id'] = $existRecordID;
										$detailData['locale_id'] = $locale['id'];							
										$projectTableLocale->insert($detailData);	
									}
								
								}
							}
						}
						$result['status'] = 'OK';
						$result['message1'] = 'Csv imported successfully.';
						$this->memCached->setItem('aula_asset_data','');
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
	public function uploadlogoAction()
    {
        $aData = (array)$aData;
		
        if ($this->request->isPost()) {

            $file = $_FILES['photo'];
            $filename = $_FILES['photo']['name'];
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
				$result['photo'] = $filename;

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
		$activeLocalesArray = $this->AdminfunctionsPlugin()->getActiveLocales($this->dbAdapter);
		$csvData = '';		
		
		$csvData .= "#ID,Asset Type,Cost,Tax Type,Tax Value,Currency,Currency Eexchange Rate,Published(Yes|No),Country,";
		foreach($activeLocalesArray as $locale)
		{
			$csvData .= "Name(".$locale['name']."),";
			$csvData .= "Description(".$locale['name']."),";
			
			
		}
		$csvData .= "\n";
		header('Content-Type: text/csv; charset=utf-8');
		header("Content-Disposition: attachment; filename=asset.csv");
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
			
			
			$this->AdminfunctionsPlugin()->validateduplicatelocale($tableName,$ID,$fieldName,$EDIT_ID,'asset_id',$this->dbAdapter,$this->config);           
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
			
			if($this->memCached->hasItem('aula_asset_data') && is_array($this->memCached->getItem('aula_asset_data')))
			{
				$asset = $this->memCached->getItem('aula_asset_data');
				$rowset[0] = $asset[$iID];
			}
			else
			{
				$projectTable = new TableGateway('asset', $this->dbAdapter);
				$rowset = $projectTable->select(array('id' => $iID));
				$rowset = $rowset->toArray();
			}

            foreach ($rowset as $record)
                $recs[] = $record;
			
			$asset_type_id = $recs[0]['asset_type_id'];
			unset($recs[0]['asset_type_id']);
			$recs[0]['asset_type_id'] = $asset_type_id;

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

            $projectTable = new TableGateway('asset', $this->dbAdapter);
			$projectTableLocale = new TableGateway('asset_locale', $this->dbAdapter);

            if ($this->request->getPost("pAction") == "DELETE") {
                $iMasterID = $this->request->getPost("KEY_ID");
				
				$projectTable->delete(array("id=".$iMasterID));
				$projectTableLocale->delete(array("asset_id=".$iMasterID));
				$this->memCached->setItem('aula_asset_data','');
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
		$tableName = 'asset';
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
			$this->memCached->setItem('aula_asset_data','');
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
		$tableName = 'asset';
		$tableNameLocale = 'asset_locale';
        if ($this->request->isPost()) {

            $projectTable = new TableGateway($tableName,$this->dbAdapter);
			$projectTableLocale = new TableGateway($tableNameLocale,$this->dbAdapter);
			
			$aData = json_decode($this->request->getPost("FORM_DATA"));
			$aData = (array)$aData;			
			
			$aData['published'] 		= $this->setCheckboxValue($aData,'published','Yes','No');
			
			if ($this->request->getPost("pAction") == "ADD")
			{
				$masterData = array();
				$masterData['asset_type_id'] 						= $aData['asset_type_id'];
				$masterData['cost'] 								= $aData['cost'];
				$masterData['tax_type'] 							= $aData['tax_type'];
				$masterData['tax_value'] 							= $aData['tax_value'];
				$masterData['currency'] 							= $aData['currency'];
				$masterData['currency_exchange_rate_id'] 			= $aData['currency_exchange_rate_id'];
				$masterData['country_id'] 							= $aData['country_id'];
				$masterData['published'] 							= $aData['published'];
				
				$masterData['owner_organization_id'] 				= self::$Aula_OwnerOrgID;
				$masterData['owner_organization_user_id'] 			= self::$Aula_OwnerOrgUserID;
				$projectTable->insert($masterData);	
				$iMasterID = $projectTable->lastInsertValue;	
				foreach($activeLocalesArray as $locale)
				{
					$detailData = array();
					$detailData['name'] 		= $aData['name_'.$locale['id']];
					$detailData['description']  = $aData['description_'.$locale['id']];
					$detailData['photo'] 		= $aData['photohidden_'.$locale['id']];
					$detailData['locale_id']    = $locale['id'];
					$detailData['asset_id']	    = $iMasterID;
					
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
				$masterData['asset_type_id'] 						= $aData['asset_type_id'];
				$masterData['cost'] 								= $aData['cost'];
				$masterData['tax_type'] 							= $aData['tax_type'];
				$masterData['tax_value'] 							= $aData['tax_value'];
				$masterData['currency'] 							= $aData['currency'];
				$masterData['currency_exchange_rate_id'] 			= $aData['currency_exchange_rate_id'];
				$masterData['country_id'] 							= $aData['country_id'];
				$masterData['published'] 							= $aData['published'];
				$masterData['date_updated'] 		= date('Y-m-d H:i:s');
				$projectTable->update($masterData,array("id=".$iMasterID));
				foreach($activeLocalesArray as $locale)
				{
					$detailData = array();
					$detailData['name'] 		= $aData['name_'.$locale['id']];
					$detailData['description']  = $aData['description_'.$locale['id']];
					$detailData['photo'] 		= $aData['photohidden_'.$locale['id']];
					
					$rowset = $projectTableLocale->select(array("asset_id=".$iMasterID,"locale_id=".$locale['id']));
					$rowset = $rowset->toArray();
					if(isset($rowset[0]['id']) && $rowset[0]['id'] > 0 ) 
					{					
						$detailData['date_updated'] = date('Y-m-d H:i:s');
						$projectTableLocale->update($detailData,array("id=".$rowset[0]['id']));						
					} 
					else 
					{
						$detailData['locale_id']    = $locale['id'];
						$detailData['asset_id'] = $iMasterID;
						$detailData['owner_organization_id'] 		= self::$Aula_OwnerOrgID;
						$detailData['owner_organization_user_id'] 	= self::$Aula_OwnerOrgUserID;
						$projectTableLocale->insert($detailData);	
					}
					
				}									
				$result['DBStatus'] = 'OK';
			}
			$this->memCached->setItem('aula_asset_data','');
        }
        else
        {
            $result['DBStatus'] = 'ERR';
        }

        $result = json_encode($result);
        echo $result;
        exit;
    }
	public function getassetAction() 
	  {                
		$sql="select id as id,name as name,published from view_asset where published='Yes' ";		        
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
