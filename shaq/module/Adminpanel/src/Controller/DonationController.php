<?php
namespace Aula_Adminpanel\Controller;

use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Db\Sql\Sql as Sql;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Adapter\AdapterInterface;

class DonationController extends AbstractActionController
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
		
		//$this->redisCache->flush();
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
		$aColumns = array('`id`','`beneficiary`','`asset`','`asset_type`','`asset_quantity`','`asset_condition`','`asset_value`','`status`');
		if(!($this->memCached->hasItem('aula_donation_data')) || !is_array($this->memCached->getItem('aula_donation_data')))
		{	
			$sTable = 'view_beneficiary_profile_asset_received';
		
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
			$this->memCached->setItem('aula_donation_data',$rowsetCache);
		}
			
		$rowset = $this->memCached->getItem('aula_donation_data');
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
			$csvData = '';
			$sql = "SELECT * FROM beneficiary_group WHERE 1 = 1";
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
			
			$csvData .= "#ID,Name,Description";
			$csvData .= "\n";
			foreach($rowset as $row)
			{
				
				$csvData .= $row['id'].",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['name']).",";
				$csvData .= $this->AdminfunctionsPlugin()->exportDataValidate($row['description']).",";
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
        $projectTable = new TableGateway('beneficiary_group',$this->dbAdapter);
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
							if($data[1] != "" && $data[2] != "")
							{
								
							 	
								$saveDataArray = array();
								$column_index = 1;
								$saveDataArray['name'] 				= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
								$saveDataArray['description'] 		= $this->AdminfunctionsPlugin()->importDataValidate($data[$column_index++]);
													
								$existRecordID = $this->AdminfunctionsPlugin()->validateduplicateCSV('beneficiary_group',$saveDataArray['name'],'name',$this->dbAdapter,$data[0]);  
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
									
									
									$saveDataArray['organization_id'] = self::$Aula_OwnerOrgID;
									$saveDataArray['owner_organization_id'] = self::$Aula_OwnerOrgID;
									$saveDataArray['owner_organization_user_id'] = self::$Aula_OwnerOrgUserID;								
									$projectTable->insert($saveDataArray);	
								}
							}
						}
						$result['status'] = 'OK';
						$result['message1'] = 'Csv imported successfully.';
						$this->memCached->setItem('aula_donation_data','');
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
		$csvData .= "#ID,Beneficiary Name,Asset,Asset Type,Asset Unit,Asset Quantity,Asset Condition,Asset Value,Receipt Number,Donor,Hash ID,Currency,Currency Exchange Rate,Amount,Status,Country,Payment Method,Received By,Collection Currency,Date of Collection,Collection Type";
		$csvData .= "\n";
		header('Content-Type: text/csv; charset=utf-8');
		header("Content-Disposition: attachment; filename=donations.csv");
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
			
			if($this->memCached->hasItem('aula_donation_data') && is_array($this->memCached->getItem('aula_donation_data')))
			{
				$beneficiary_group = $this->memCached->getItem('aula_donation_data');
				$rowset[0] = $beneficiary_group[$iID];
			}
			else
			{
				$projectTable = new TableGateway('view_beneficiary_profile_asset_received', $this->dbAdapter);
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

            $projectTable = new TableGateway('beneficiary_group', $this->dbAdapter);

            if ($this->request->getPost("pAction") == "DELETE") {
                $iMasterID = $this->request->getPost("KEY_ID");
				
					$projectTable->delete(array("id=".$iMasterID));
					$this->memCached->setItem('aula_donation_data','');
					$result['DBStatus'] = 'OK';
				
                $result = json_encode($result);
				
                echo $result;
                exit;
            }
        }
    }
    public function saveAction()
    {        
		
        if ($this->request->isPost()) {

            $projectTable = new TableGateway('beneficiary_profile_asset_received',$this->dbAdapter);
			$paymentTable = new TableGateway('payment',$this->dbAdapter);
			$paymentOfflineDetailsTable = new TableGateway('payment_offline_details',$this->dbAdapter);
			$transactionDetailsTable = new TableGateway('transaction',$this->dbAdapter);
			$transactionEntryDetailsTable = new TableGateway('transaction_entries',$this->dbAdapter);
			
			$aData = json_decode($this->request->getPost("FORM_DATA"));
			$aData = (array)$aData;
			$received=array();
			$payment=array();
			$offline=array();
			$transaction=array();
			$transaction_entries=array();
			if($aData['date_of_collection'] != '') {
				$date_of_collection_ar 		 = explode("/",$aData['date_of_collection']);
				$date_of_collection 		 = $date_of_collection_ar[2].'-'.$date_of_collection_ar[0].'-'.$date_of_collection_ar[1];
			}
			if($aData['insertion_date'] != '') {
				$insertion_date_ar 		 = explode("/",$aData['insertion_date']);
				$insertion_date 		 = $insertion_date_ar[2].'-'.$insertion_date_ar[0].'-'.$insertion_date_ar[1];
			}
			if($aData['transaction_date'] != '') {
				$transaction_date_ar 	   = explode("/",$aData['transaction_date']);
				$transaction_date 		   = $transaction_date_ar[2].'-'.$transaction_date_ar[0].'-'.$transaction_date_ar[1];
			}
			if($aData['posting_date'] != '') {
				$posting_date_ar 	   = explode("/",$aData['posting_date']);
				$posting_date 		   = $posting_date_ar[2].'-'.$posting_date_ar[0].'-'.$posting_date_ar[1];
			}
			
			$sql="select id as id,exchange_rate from currency_exchange_rate where from_currency=".$aData['collection_currency']." and to_currency=".$aData['currency']." and status='Active'";
			$optionalParameters=array();        
			$statement 		   = $this->dbAdapter->createStatement($sql, $optionalParameters);       
			$result1 = $statement->execute();        
			$resultSet = new ResultSet;        
			$resultSet->initialize($result1);        
			$rowset=$resultSet->toArray();
			$exchange_rate=$rowset[0]['id'];
			if($rowset[0]['id']!='')
			{
				
				$offline['currency_exchange_rate_id'] 	  = $exchange_rate;
				$payment['currency_exchange_rate_id'] 	  = $exchange_rate;
			}
			else
			{
				
				$offline['currency_exchange_rate_id'] 	   = 0;
				$payment['currency_exchange_rate_id']	   = 0;
			}
			if ($this->request->getPost("pAction") == "ADD")
			{	
				unset($aData['MASTER_KEY_ID']);
				$received['asset_id'] 							= $aData['asset_id'];	
				$received['asset_type_id'] 						= $aData['asset_type_id'];	
				$received['asset_unit_id'] 						= $aData['asset_unit_id'];	
				$received['asset_quantity'] 					= $aData['asset_quantity'];	
				$received['asset_condition_id'] 				= $aData['asset_condition_id'];	
				$received['asset_value'] 						= $aData['asset_value'];	
				$received['receipt_number'] 					= $aData['receipt_number'];
				$received['status'] 							= 'Received';
				$received['donor_id'] 							= $aData['donor_id'];	
				$received['beneficiary_id'] 					= $aData['beneficiary_id'];
				$received['owner_organization_id'] 				= self::$Aula_OwnerOrgID;
				$received['owner_organization_user_id'] 		= self::$Aula_OwnerOrgUserID;
				$projectTable->insert($received);
				
				$payment['donor_id'] 							= $aData['donor_id'];
				$payment['organization_id'] 					= self::$Aula_OwnerOrgID;
				$payment['organization_branch_id'] 				= self::$Aula_OwnerOrgID;
				$payment['hash_id'] 							= 0;
				$payment['currency'] 							= $aData['currency'];
				$payment['amount'] 								= $aData['amount'];
				$payment['status'] 								= $aData['status'];
				$payment['payment_method_id'] 					= $aData['payment_method_id'];
				$payment['country_id'] 							= $aData['country_id'];
				$paymentTable->insert($payment);
				$paymentID = $paymentTable->lastInsertValue;
					
				$offline['payment_id'] 							= $paymentID;
				$offline['received_by'] 						= $aData['received_by'];	
				$offline['currency'] 							= $aData['currency'];	
				$offline['amount'] 								= $aData['amount'];	
				$offline['collection_type'] 					= $aData['collection_type'];
				$offline['collection_currency'] 				= $aData['collection_currency'];
				$offline['date_of_collection'] 					= $date_of_collection;
				$paymentOfflineDetailsTable->insert($offline);
				
				$transaction['description']						= $aData['description'];	
				$transaction['insertion_date']					= $insertion_date;	
				$transaction['transaction_type_id']				= $aData['transaction_type_id'];
				$transactionDetailsTable->insert($transaction);
				$transactionID = $transactionDetailsTable->lastInsertValue;	
				
				$transaction_entries['transaction_id']			= $transactionID;
				$transaction_entries['transaction_entry_seq']	= $aData['transaction_entry_seq'];
				$transaction_entries['debit_credit_flag']		= $aData['debit_credit_flag'];
				$transaction_entries['transaction_amount']		= $aData['transaction_amount'];
				$transaction_entries['transaction_date']		= $transaction_date;
				$transaction_entries['posting_date']			= $posting_date;
				$transaction_entries['gl_account_id']			= $aData['gl_account_id'];
				$transactionEntryDetailsTable->insert($transaction_entries);						
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
			$this->memCached->setItem('aula_donation_data','');
        }
        else
        {
            $result['DBStatus'] = 'ERR';
        }

        $result = json_encode($result);
        echo $result;
        exit;
    }
	/************* START BENEFICIARY DONATION SAVE ************/
	public function savenewdonationAction()
    {
		if ($this->request->isPost()) {

            $projectTable = new TableGateway('beneficiary_profile_asset_received',$this->dbAdapter);
			$paymentTable = new TableGateway('payment',$this->dbAdapter);
			$paymentOfflineDetailsTable = new TableGateway('payment_offline_details',$this->dbAdapter);
			$transactionDetailsTable = new TableGateway('transaction',$this->dbAdapter);
			$transactionEntryDetailsTable = new TableGateway('transaction_entries',$this->dbAdapter);
			
			$aData = json_decode($this->request->getPost("FORM_DATA"));
			$aData = (array)$aData;
			$received=array();
			$payment=array();
			$offline=array();
			$transaction=array();
			$transaction_entries=array();
			
			if($aData['date_of_collection'] != '') {
				$date_of_collection_ar 		 = explode("/",$aData['date_of_collection']);
				$date_of_collection 		 = $date_of_collection_ar[2].'-'.$date_of_collection_ar[0].'-'.$date_of_collection_ar[1];
			}
			
			if($aData['insertion_date'] != '') {
				$insertion_date_ar 		 = explode("/",$aData['insertion_date']);
				$insertion_date			 = $insertion_date_ar[2].'-'.$insertion_date_ar[0].'-'.$insertion_date_ar[1];
			}
			
			if($aData['transaction_date'] != '') {
				$transaction_date_ar 	   = explode("/",$aData['transaction_date']);
				$transaction_date 		   = $transaction_date_ar[2].'-'.$transaction_date_ar[0].'-'.$transaction_date_ar[1];
			}
			
			if($aData['posting_date'] != '') {
				$posting_date_ar 	   = explode("/",$aData['posting_date']);
				$posting_date 		   = $posting_date_ar[2].'-'.$posting_date_ar[0].'-'.$posting_date_ar[1];
			}	
			
			
			$sql="select id as id,exchange_rate from currency_exchange_rate where from_currency=".$aData['collection_currency']." and to_currency=".$aData['currency']." and status='Active'";	
			$optionalParameters=array();        
			$statement 		   = $this->dbAdapter->createStatement($sql, $optionalParameters);       
			$result1 = $statement->execute();        
			$resultSet = new ResultSet;        
			$resultSet->initialize($result1);        
			$rowset=$resultSet->toArray();
			$exchange_rate=$rowset[0]['id'];
			if($rowset[0]['id']!='')
			{
				
				$offline['currency_exchange_rate_id'] 	  = $exchange_rate;
				$payment['currency_exchange_rate_id'] 	  = $exchange_rate;
			}
			else
			{
				
				$offline['currency_exchange_rate_id'] 	   = 0;
				$payment['currency_exchange_rate_id']	   = 0;
			}
				
				
			unset($aData['MASTER_KEY_ID']);
			$received['asset_id'] 							= $aData['asset_id'];	
			$received['asset_type_id'] 						= $aData['asset_type_id'];	
			$received['asset_unit_id'] 						= $aData['asset_unit_id'];	
			$received['asset_quantity']						= $aData['asset_quantity'];	
			$received['asset_condition_id'] 				= $aData['asset_condition_id'];	
			$received['asset_value'] 						= $aData['asset_value'];	
			$received['receipt_number'] 					= $aData['receipt_number'];
			$received['status'] 							= 'Received';
			$received['donor_id'] 							= $aData['donor_id'];	
			$received['beneficiary_id'] 					= $aData['beneficiary_id'];
			$received['owner_organization_id']				= self::$Aula_OwnerOrgID;
			$received['owner_organization_user_id'] 		= self::$Aula_OwnerOrgUserID;
			$projectTable->insert($received);
			
			$payment['donor_id'] 							= $aData['donor_id'];
			$payment['organization_id'] 					= self::$Aula_OwnerOrgID;
			$payment['organization_branch_id'] 				= self::$Aula_OwnerOrgID;
			$payment['hash_id']								= 0;
			$payment['currency'] 							= $aData['currency'];
			$payment['amount'] 								= $aData['amount'];
			$payment['status'] 								= $aData['status'];
			$payment['payment_method_id'] 					= $aData['payment_method_id'];
			$payment['country_id'] 							= $aData['country_id'];
			$paymentTable->insert($payment);
			$paymentID = $paymentTable->lastInsertValue;
				
			$offline['payment_id'] 							= $paymentID;
			$offline['received_by'] 						= $aData['received_by'];	
			$offline['currency'] 							= $aData['currency'];	
			$offline['amount'] 								= $aData['amount'];	
			$offline['collection_type'] 					= $aData['collection_type'];
			$offline['collection_currency'] 				= $aData['collection_currency'];
			$offline['date_of_collection'] 					= $date_of_collection;
			$paymentOfflineDetailsTable->insert($offline);	
			
			$transaction['description']						= $aData['description'];	
			$transaction['insertion_date']					= $insertion_date;	
			$transaction['transaction_type_id']				= $aData['transaction_type_id'];
			$transactionDetailsTable->insert($transaction);
			$transactionID = $transactionDetailsTable->lastInsertValue;	
			
			$transaction_entries['transaction_id']		 	= $transactionID;
			$transaction_entries['transaction_entry_seq']	= $aData['transaction_entry_seq'];
			$transaction_entries['debit_credit_flag']		= $aData['debit_credit_flag'];
			$transaction_entries['transaction_amount']		= $aData['transaction_amount'];
			$transaction_entries['transaction_date']		= $transaction_date;
			$transaction_entries['posting_date']			= $posting_date;
			$transaction_entries['gl_account_id']			= $aData['gl_account_id'];
			$transactionEntryDetailsTable->insert($transaction_entries);		
			$result['DBStatus'] = 'OK';
			
			$this->memCached->setItem('aula_donation_data','');
        }
        else
        {
            $result['DBStatus'] = 'ERR';
        }

        $result = json_encode($result);
        echo $result;
        exit;
	}
	/************* END BENEFICIARY DONATION SAVE ************/
	public function getgroupAction() 
	  {                
		$sql="select id as id,name as name from beneficiary_group";		        
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
