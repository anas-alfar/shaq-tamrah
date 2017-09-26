<?php
namespace Aula_Adminpanel\Controller;

use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Db\Sql\Sql as Sql;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Adapter\AdapterInterface;

class MenuController extends AbstractActionController
{
	private $dbAdapter;
	private $sessionContainer;
	protected $request;
	private $config;
	private $redisCache;
	private $memCached;
	private $global_locale_id;
	private $draggable_menu_list;
	
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
	public function list1Action()
    {
        echo $this->fnGrid1();
        exit;
    }
	
	public function fnGrid()
	{
		
		$aColumns = array( '`id`','`name`','`status`','`sequence`','`menu_category`','`country`','`organization_branch_name`','`published`');
		if(!($this->memCached->hasItem('aula_menu_data')) || !is_array($this->memCached->getItem('aula_menu_data')))
		{	
			$sTable = 'view_menu';
		
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
			$this->memCached->setItem('aula_menu_data',$rowsetCache);
		}
			
		$rowset = $this->memCached->getItem('aula_menu_data');
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
	public function getMenuItemRecursively($menu_id,$parent_id)
	{
		$sTable = 'view_menu_item';
		
		/* Indexed column (used for fast and accurate table cardinality) */
		$sIndexColumn = "id";  
		
		$sWhere = " WHERE menu_id='".$menu_id."' AND parent_id = '".$parent_id."' ";
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
		
		$this->draggable_menu_list .= '<ol class="dd-list">';
		$rowsetCache = array();
		
		foreach($rowset as $aRow)
		{			
			$this->draggable_menu_list .= '<li class="dd-item dd3-item" data-id="'.$aRow['id'].'">
											<div class="dd-handle dd3-handle">&nbsp;</div>
											<div class="dd3-content">
												'.$aRow['name'].'												
												<span class="pull-right"> 
													<div class="btn-group" style="width:140px;">
														<a href="#" title="View" class="btn btn-primary fa fa-eye btn-sm view_drag " row-id="'.$aRow['id'].'"></a>
														<a href="#" title="Edit" class="btn btn-success fa fa-pencil-square-o btn-sm edit_drag " row-id="'.$aRow['id'].'"></a>
														<a href="#" title="Delete" class="btn btn-info fa fa-trash-o btn-sm delete_drag " row-id="'.$aRow['id'].'"></a>
													</div>
												</span>										
											</div>';
			$this->getMenuItemRecursively($menu_id,$aRow['id']);
			$this->draggable_menu_list .= '</li>';
		}
		$this->draggable_menu_list .= '</ol>';
		return;
	}
	public function getmenulistAction()
	{
		$menu_id = $this->request->getPost("menu_id");
		$this->draggable_menu_list = '';
		$this->getMenuItemRecursively($menu_id,0);
		
		/** Output **/
		$output = array(
			"status" => 'OK',
			"draggable_menu_list" => $this->draggable_menu_list
		);
		echo json_encode( $output ); 
		die();
	}
	public function saveMenuOrderRecursively($menuItemArray,$parentId)
	{
		$tableName = 'menu_item';
		$projectTable = new TableGateway($tableName,$this->dbAdapter);
		
		$sequence = 0;
		foreach($menuItemArray as $menuItem)
		{
			$sequence++;
			$updateData = array();
			$updateData["sequence"]=$sequence;
			$updateData["parent_id"]=$parentId;
			//print_r($updateData);
			$projectTable->update($updateData,array("id=".$menuItem['id']));
			if(is_array($menuItem['children']) && count($menuItem['children']) > 0)
			{
				$this->saveMenuOrderRecursively($menuItem['children'],$menuItem['id']);
			}				
		}
	}
	public function savemenuorderAction()
	{		 
        if ($this->request->isPost()) {		
            
			$aData = json_decode($this->request->getPost("menuorder"),true);
			$aData = (array)$aData;			
			$orderRecordsArray = $aData;
			
			$this->saveMenuOrderRecursively($orderRecordsArray,0);
			
		}

        $output = array(
			"DBStatus" => 'OK'
		);
		echo json_encode( $output ); 
		die();
	}
	public function fnGrid1()
	{
		$menu_id = $this->request->getPost("menu_id");
		$activeLocalesArray = $this->AdminfunctionsPlugin()->getActiveLocales($this->dbAdapter);
		$aColumns = array( '`id`','`name`','`link`','`menu`','`parent`','`published`','`sequence`');
		if(!($this->memCached->hasItem('aula_menuitem_data')) || !is_array($this->memCached->getItem('aula_menuitem_data')))
		{	
			$sTable = 'view_menu_item';
		
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
					$sQuery_locale 		= "SELECT name,link FROM menu_item_locale WHERE locale_id = '".$locale['id']."' AND menu_item_id = '".$aRow['id']."' ";
					$statement_locale	= $this->dbAdapter->createStatement($sQuery_locale, $optionalParameters);        
					$resultData_locale	= $statement_locale->execute();        
					$resultSet_locale	= new ResultSet; 			   
					$resultSet_locale->initialize($resultData_locale);        
					$rowset_locale		= $resultSet_locale->toArray();
					$aRow['name_'.$locale['id']] = $rowset_locale[0]['name'];
					$aRow['link_'.$locale['id']] = $rowset_locale[0]['link'];
				}
				$rowsetCache[$aRow['id']] = $aRow;
			}
			$this->memCached->setItem('aula_menuitem_data',$rowsetCache);
		}
			
		$rowset = $this->memCached->getItem('aula_menuitem_data');
		$iTotal = count($rowset);
		
		
		
		/** Output **/
		$output = array(
			"sEcho" => intval(@$_GET['sEcho']),
			"iTotalRecords" => $iTotal,
			"aaData" => array()
		);
	
		foreach($rowset as $aRow)
		{
			if($menu_id > 0 && $aRow['menu_id'] != $menu_id )
				continue;
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
		
			$csvData = '';
			$sql = "SELECT * FROM view_menu WHERE 1 = 1";	
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
			
			$csvData .= "#ID,Name,Status,Sequence,Menu Category,Country,Organization Branch Name,Published(Yes|No)";
			$csvData .= "\n";
			foreach($rowset as $row)
			{
				$csvData .= $row['id'].",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['name']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['status']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['sequence']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['menu_category']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['country']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['organization_branch_name']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['published']).",";
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
	public function exportcsv1Action()
	{
		if ($this->request->isPost()) 
		{
			$menu_id = $this->request->getPost("parentId");
			
			$activeLocalesArray = $this->AdminfunctionsPlugin()->getActiveLocales($this->dbAdapter);		
			
			$csvData = '';		
			$sql = "SELECT * FROM view_menu_item WHERE 1 = 1";
			if($menu_id > 0)
			 $sql .= " AND menu_id = '".$menu_id."'  ";
			if($this->request->getPost("export_data") != "ALL")
			{
				$aData = json_decode($this->request->getPost("FORM_DATA1"));
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
			$csvData .= "#ID,Parent,Published(Yes|No),Sequence,";
			foreach($activeLocalesArray as $locale)
			{
				$csvData .= "Name(".$locale['name']."),";
				$csvData .= "Link(".$locale['name']."),";
				
			}
			$csvData .= "\n";
				
			
			foreach($rowset as $row)
			{
				
				$csvData .= $row['id'].",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['parent']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['published']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['sequence']).",";
				foreach($activeLocalesArray as $locale)
					{
						$sQuery_locale1 		= "SELECT name,link FROM menu_item_locale WHERE locale_id = '".$locale['id']."' AND menu_item_id = '".$row['id']."' ";
						$statement_locale	= $this->dbAdapter->createStatement($sQuery_locale1, $optionalParameters);        
						$resultData_locale	= $statement_locale->execute();        
						$resultSet_locale	= new ResultSet; 			   
						$resultSet_locale->initialize($resultData_locale);        
						$rowset_locale		= $resultSet_locale->toArray();
						$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($rowset_locale[0]['name']).",";
						$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($rowset_locale[0]['link']).",";
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
        $projectTable = new TableGateway('menu',$this->dbAdapter);
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
							if($data[1] != "" && $data[2] != "" && $data[3] != ""&& $data[4] != ""&& $data[5] != "")
							{
							 
								$saveDataArray = array();
								$column_index = 1;
								$saveDataArray['name'] 	= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$saveDataArray['status'] 	= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$saveDataArray['sequence'] 	= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$getMenucategoryID = $this->AdminfunctionsPlugin()->validateduplicateLocaleCSV('menu_category_locale',$this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]),'name','menu_category_id',$this->dbAdapter,$this->config['global_locale_id'],'locale_id');
								$saveDataArray['menu_category_id']= $getMenucategoryID;
								
								$getCountryID = $this->AdminfunctionsPlugin()->validateduplicateLocaleCSV('country_locale',$this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]),'name','country_id',$this->dbAdapter,$this->config['global_locale_id'],'locale_id');
								$saveDataArray['country_id']= $getCountryID;
								
								
								
								$getBranchID = $this->AdminfunctionsPlugin()->validateduplicateLocaleCSV('organization_branch_locale',$this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]),'name','organization_branch_id',$this->dbAdapter,$this->config['global_locale_id'],'locale_id');
								$saveDataArray['organization_branch_id']= $getBranchID;
								
								$saveDataArray['published'] 	= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								
								
								$fnameValPair = array();
								$fnameValPair['menu_category_id ']=$saveDataArray['menu_category_id'];
								$fnameValPair['country_id ']=$saveDataArray['country_id'];
								
								$existRecordID = $this->AdminfunctionsPlugin()->validateduplicatemultipleCSV('view_menu',$data[0],$fnameValPair,$this->dbAdapter);	
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
								
									$saveDataArray['menu_category_id']= $getMenucategoryID;
									$saveDataArray['country_id']= $getCountryID;
									$saveDataArray['organization_id'] 	= self::$Aula_OrgID;;
									$saveDataArray['organization_branch_id']= $getBranchID;
									$saveDataArray['owner_organization_id'] = self::$Aula_OwnerOrgID;
									$saveDataArray['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;								
									$projectTable->insert($saveDataArray);	
								}
							}
						}
						$result['status'] = 'OK';
						$result['message1'] = 'Csv imported successfully.';
						$this->memCached->setItem('aula_menu_data','');
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
	public function importcsv1Action()
    {		
		$menu_id = $this->request->getPost("parentId");	
		$activeLocalesArray = $this->AdminfunctionsPlugin()->getActiveLocales($this->dbAdapter);
        $projectTable = new TableGateway('menu_item',$this->dbAdapter);
		$projectTableLocale = new TableGateway('menu_item_locale',$this->dbAdapter);
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
							if($data[3] != "" && $data[4] != "" && $data[5] != ""&& $data[6] != "" )
							{
								$saveDataArray = array();
								$column_index = 1;
								$saveDataArray['menu_id'] 	= $menu_id;
							 	$getParentID = $this->AdminfunctionsPlugin()->validateduplicateLocaleCSV('menu_item_locale',$this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]),'name','menu_item_id',$this->dbAdapter,$this->config['global_locale_id'],'locale_id');
								
								
								$saveDataArray['parent_id']= $getParentID;
								$saveDataArray['published'] 	= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$saveDataArray['sequence'] 	= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								
								$detailData = array();
								$detailData['name'] = $data[$column_index++];
								$detailData['link'] = $data[$column_index++];
								
								$existRecordID = $this->AdminfunctionsPlugin()->validateduplicateCSV('view_menu_item',$detailData['name'],'name',$this->dbAdapter,$data[0]);	
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
									$projectTableLocale->update($detailData,array("menu_item_id=".$existRecordID,"locale_id=".$this->config['global_locale_id']));	
								}
								else
								{
									
									$saveDataArray['owner_organization_id'] = self::$Aula_OwnerOrgID;
									$saveDataArray['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;								
									$projectTable->insert($saveDataArray);	
									$existRecordID = $projectTable->lastInsertValue;	
									
									$detailData['owner_organization_id'] = self::$Aula_OwnerOrgID;
									$detailData['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;	
									$detailData['menu_item_id'] = $existRecordID;
									$detailData['locale_id'] = $this->config['global_locale_id'];							
									$projectTableLocale->insert($detailData);	
								}
								foreach($activeLocalesArray as $locale)
								{
									if($locale['id'] == $this->config['global_locale_id'])
										continue;
										
									$existLocaleRecordID = $this->AdminfunctionsPlugin()->validateduplicateLocaleCSV('menu_item_locale',$existRecordID,'menu_item_id','id',$this->dbAdapter,$locale['id'],'locale_id'); 
									
									$detailData = array();
									$detailData['name'] = $data[$column_index++];
									$detailData['link'] = $data[$column_index++];
									
									
									if($existLocaleRecordID > 0)
									{										
										$detailData['date_updated'] = date('Y-m-d H:i:s');
										$projectTableLocale->update($detailData,array("id=".$existLocaleRecordID));
									}
									else
									{										
										$detailData['owner_organization_id'] = self::$Aula_OwnerOrgID;
										$detailData['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;	
										$detailData['menu_item_id'] = $existRecordID;
										$detailData['locale_id'] = $locale['id'];							
										$projectTableLocale->insert($detailData);	
									}
								
								}
							}
						}
						$result['status'] = 'OK';
						$result['message1'] = 'Csv imported successfully.';
						$this->memCached->setItem('aula_menuitem_data','');
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
		$csvData .= "#ID,Name,Status,Sequence,Menu Category,Country,Organization Branch Name,Published(Yes|No)";
		$csvData .= "\n";
		header('Content-Type: text/csv; charset=utf-8');
		header("Content-Disposition: attachment; filename=menu.csv");
		echo $csvData;
		exit;
	}
	public function downloadtemplate1Action()
	{
		$activeLocalesArray = $this->AdminfunctionsPlugin()->getActiveLocales($this->dbAdapter);
		$csvData = '';		
		
		$csvData .= "#ID,Parent,Published(Yes|No),Sequence,";
		foreach($activeLocalesArray as $locale)
		{
			$csvData .= "Name(".$locale['name']."),";
			$csvData .= "Link(".$locale['name']."),";
			
		}
		$csvData .= "\n";
		header('Content-Type: text/csv; charset=utf-8');
		header("Content-Disposition: attachment; filename=menu-item.csv");
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
	public function validateduplicate1Action()
    {
        if ($this->request->isPost()) {
            $tableName = $this->request->getPost('tableName');
            $ID = $this->request->getPost('KEY_ID');
			$EDIT_ID = $this->request->getPost('iActiveID');
            $fieldName = $this->request->getPost('fieldName'); 
			
			
			$this->AdminfunctionsPlugin()->validateduplicatelocale($tableName,$ID,$fieldName,$EDIT_ID,'menu_item_id',$this->dbAdapter,$this->config);           
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
			
			if($this->memCached->hasItem('aula_menu_data') && is_array($this->memCached->getItem('aula_menu_data')))
			{
				$menu = $this->memCached->getItem('aula_menu_data');
				$rowset[0] = $menu[$iID];
			}
			else
			{
				$projectTable = new TableGateway('menu', $this->dbAdapter);
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
	public function getrec1Action()
    {
        $recs=array();
        if ($this->request->isPost()) {
            $activeLocalesArray = $this->AdminfunctionsPlugin()->getActiveLocales($this->dbAdapter);
			$iID = $this->request->getPost("KEY_ID");
			
			if($this->memCached->hasItem('aula_menuitem_data') && is_array($this->memCached->getItem('aula_menuitem_data')))
			{
				$menu_item = $this->memCached->getItem('aula_menuitem_data');
				$rowset[0] = $menu_item[$iID];
			}
			else
			{
				$projectTable = new TableGateway('menu_item', $this->dbAdapter);
				$rowset = $projectTable->select(array('id' => $iID));
				$rowset = $rowset->toArray();
			}

            foreach ($rowset as $record)
			{
				foreach($activeLocalesArray as $locale)
				{
					
					$sQuery_locale 		= "SELECT name,link FROM menu_item_locale WHERE locale_id = '".$locale['id']."' AND menu_item_id = '".$record['id']."' ";
					$statement_locale	= $this->dbAdapter->createStatement($sQuery_locale, $optionalParameters);        
					$resultData_locale	= $statement_locale->execute();        
					$resultSet_locale	= new ResultSet; 			   
					$resultSet_locale->initialize($resultData_locale);        
					$rowset_locale		= $resultSet_locale->toArray();
					$record['name_'.$locale['id']] = $rowset_locale[0]['name'];
					$record['link_'.$locale['id']] = $rowset_locale[0]['link'];
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
	
	public function  deleteAction()
    {
        
        if ($this->request->isPost()) {

            $projectTable = new TableGateway('menu', $this->dbAdapter);

            if ($this->request->getPost("pAction") == "DELETE") {
                $iMasterID = $this->request->getPost("KEY_ID");
				
				$projectTable->delete(array("id=".$iMasterID));
				$this->memCached->setItem('aula_menu_data','');
                $result['DBStatus'] = 'OK';
                $result = json_encode($result);
                echo $result;
                exit;
            }
        }
    }
	public function  delete1Action()
    {
        
        if ($this->request->isPost()) {

            $projectTable = new TableGateway('menu_item', $this->dbAdapter);
			$projectTableLocale = new TableGateway('menu_item_locale', $this->dbAdapter);

            if ($this->request->getPost("pAction") == "DELETE1") {
                $iMasterID = $this->request->getPost("KEY_ID");
				
				$projectTable->delete(array("id=".$iMasterID));
				$projectTableLocale->delete(array("menu_item_id=".$iMasterID));
				$this->memCached->setItem('aula_menuitem_data','');
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
		$tableName = 'menu';
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
			$this->memCached->setItem('aula_menu_data','');
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
	public function bulksave1Action()
    {        
		$tableName = 'menu_item';
        if ($this->request->isPost()) {
			$menu_id = $this->request->getPost("parentId");
            $projectTable = new TableGateway($tableName,$this->dbAdapter);
			
			$aData = json_decode($this->request->getPost("FORM_DATA1"));
			$aData = (array)$aData;
			$allRecordsArray = $aData['gridHiddenIdArray[]'];
			if(!is_array($allRecordsArray))
			{				
				$allRecordsArray = array($allRecordsArray);	
			}
			foreach($allRecordsArray as $iMasterID)
			{
				$updateData = array();
				$updateData['published'] = $this->setCheckboxValue($aData,'published1'.$iMasterID,'Yes','No');
				
				$projectTable->update($updateData,array("id=".$iMasterID));				
			}
			$this->memCached->setItem('aula_menuitem_data','');
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
		$tableName = 'menu';
        if ($this->request->isPost()) {

            $projectTable = new TableGateway($tableName,$this->dbAdapter);
			
			$aData = json_decode($this->request->getPost("FORM_DATA"));
			$aData = (array)$aData;			
			$aData['published'] = $this->setCheckboxValue($aData,'published','Yes','No');

			
			if ($this->request->getPost("pAction") == "ADD")
			{	
				unset($aData['MASTER_KEY_ID']);	
						
				$aData['owner_organization_id']									 = self::$Aula_OwnerOrgID;
				$aData['organization_id']									 = self::$Aula_OrgID;
				$aData['owner_organization_user_id']							 = self::$Aula_OwnerOrgUserID;
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
			$this->memCached->setItem('aula_menu_data','');
        }
        else
        {
            $result['DBStatus'] = 'ERR';
        }

        $result = json_encode($result);
        echo $result;
        exit;
    }
	 public function save1Action()
    { 
		$activeLocalesArray = $this->AdminfunctionsPlugin()->getActiveLocales($this->dbAdapter);       
		$tableName = 'menu_item';
		$tableNameLocale = 'menu_item_locale';
        if ($this->request->isPost()) {
			$iID = $this->request->getPost("KEY_ID");
            $projectTable = new TableGateway($tableName,$this->dbAdapter);
			$projectTableLocale = new TableGateway($tableNameLocale,$this->dbAdapter);
			$aData = json_decode($this->request->getPost("FORM_DATA1"));
			$aData = (array)$aData;			
			
			$aData['published1'] = $this->setCheckboxValue($aData,'published1','Yes','No');

			if ($this->request->getPost("pAction") == "ADD1")
			{
				$sql="select sequence from menu_category order by sequence DESC LIMIT 1 ";
				
				$optionalParameters	= array();        
				$statement 			= $this->dbAdapter->createStatement($sql, $optionalParameters);        
				$resultData			= $statement->execute();        
				$resultSet 			= new ResultSet; 			   
				$resultSet->initialize($resultData);        
				$rowset 			= $resultSet->toArray();
				
				$masterData = array();
				$masterData['menu_id'] 	= $aData['menu_id'];
				$masterData['parent_id'] 	= $aData['parent_id'];
				$masterData['published'] 	= $aData['published1'];
				$masterData['sequence'] 	= $rowset[0]['sequence']+1;
				
				$masterData['owner_organization_id'] = self::$Aula_OwnerOrgID;
				$masterData['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;
				
				$projectTable->insert($masterData);	
				$iMasterID = $projectTable->lastInsertValue;	
				foreach($activeLocalesArray as $locale)
				{
					$detailData = array();
					$detailData['name'] = $aData['name_'.$locale['id']];
					$detailData['link'] = $aData['link_'.$locale['id']];
					$detailData['locale_id'] = $locale['id'];
					$detailData['menu_item_id'] = $iMasterID;
					
					$detailData['owner_organization_id'] = self::$Aula_OwnerOrgID;
					$detailData['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;
				
					$projectTableLocale->insert($detailData);	
				}									
				$result['DBStatus'] = 'OK';
			}
			else  if($this->request->getPost("pAction") == "EDIT1")
			{			
				$iMasterID=$aData['MASTER_KEY_ID'];				
				
				$masterData = array();
				$masterData['menu_id'] 	= $aData['menu_id'];
				$masterData['parent_id'] 	= $aData['parent_id'];;
				$masterData['published'] 	= $aData['published1'];
				$masterData['date_updated'] = date('Y-m-d H:i:s');
				
				$projectTable->update($masterData,array("id=".$iMasterID));
				foreach($activeLocalesArray as $locale)
				{
					$detailData = array();
					$detailData['name'] = $aData['name_'.$locale['id']];
					$detailData['link'] = $aData['link_'.$locale['id']];
					$rowset = $projectTableLocale->select(array("menu_item_id=".$iMasterID,"locale_id=".$locale['id']));
					$rowset = $rowset->toArray();
					if(isset($rowset[0]['id']) && $rowset[0]['id'] > 0 ) 
					{					
						$detailData['date_updated'] = date('Y-m-d H:i:s');
						$projectTableLocale->update($detailData,array("id=".$rowset[0]['id']));						
					} 
					else 
					{
						$detailData['locale_id'] = $locale['id'];
						$detailData['menu_item_id'] = $iMasterID;
						$detailData['owner_organization_id'] = self::$Aula_OwnerOrgID;
						$detailData['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;
						$projectTableLocale->insert($detailData);	
					}
					
				}									
				$result['DBStatus'] = 'OK';
			}
			$this->memCached->setItem('aula_menuitem_data','');
        }
        else
        {
            $result['DBStatus'] = 'ERR';
        }

        $result = json_encode($result);
        echo $result;
        exit;
    }
	public function getmenuitemAction() 
	{                
		$menu_id = $this->request->getPost("menu_id");
		$sql="select id as id,name as name from view_menu_item WHERE 1 = 1 ";		
		if($menu_id > 0)
			 $sql .= " AND menu_id = '".$menu_id."'  ";
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
