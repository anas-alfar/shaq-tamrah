<?php 
namespace Aula_Adminpanel\Controller\Plugin;
 
use Zend\Mvc\Controller\Plugin\AbstractPlugin;

use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Db\Sql\Select as Select;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\ResultSet; 
 
class AdminfunctionsPlugin extends AbstractPlugin {

	public function validateduplicate($tableName,$ID,$fieldName,$EDIT_ID,$dbAdapter)
	{
		$sql = "select id from $tableName where $fieldName='".$ID."' AND id != '".$EDIT_ID."'";

		$optionalParameters = array();
		$statement = $dbAdapter->createStatement($sql, $optionalParameters);

		$result = $statement->execute();
		$resultSet = new ResultSet;
		$resultSet->initialize($result);
		$rowset = $resultSet->toArray();

		if(count($rowset)>0) {

			$result1['recordsTotal'] = count($rowset);
			$result1['DBStatus'] = 'ERR';
		}
		else
		{
			$result1['DBStatus'] = 'OK';
		}

		$result1 = json_encode($result1);
		echo $result1;
		exit;
	}
	public function validateduplicatelocale($tableName,$ID,$fieldName,$EDIT_ID,$matchFild,$dbAdapter,$config)
	{
		 $sql = "select id from $tableName where $fieldName='".$ID."' AND $matchFild != '".$EDIT_ID."' AND locale_id='".$config['global_locale_id']."'";
		
		$optionalParameters = array();
		$statement = $dbAdapter->createStatement($sql, $optionalParameters);

		$result = $statement->execute();
		$resultSet = new ResultSet;
		$resultSet->initialize($result);
		$rowset = $resultSet->toArray();

		if(count($rowset)>0) {

			$result1['recordsTotal'] = count($rowset);
			$result1['DBStatus'] = 'ERR';
		}
		else
		{
			$result1['DBStatus'] = 'OK';
		}

		$result1 = json_encode($result1);
		echo $result1;
		exit;
	}

	public function validateduplicateCSV($tableName,$ID,$fieldName,$dbAdapter,$EDIT_ID=0)
	{
		$sql = "SELECT id FROM $tableName WHERE $fieldName='".$ID."' AND id !='".$EDIT_ID."'";

		$optionalParameters = array();
		$statement = $dbAdapter->createStatement($sql, $optionalParameters);

		$result = $statement->execute();
		$resultSet = new ResultSet;
		$resultSet->initialize($result);
		$rowset = $resultSet->toArray();

		if(count($rowset)>0) {

			return $rowset[0]['id'];
		}
		else
		{
			return 0;
		}
	}
	public function validateduplicatelocaleCSV($tableName,$fieldValue,$fieldName,$IDfield,$dbAdapter,$fieldValue2="",$fieldName2="")
	{
		$sql = "SELECT $IDfield FROM $tableName WHERE $fieldName='".$fieldValue."'";
		if($fieldValue2 != "" && $fieldName2 != "")
		{
			$sql .= " AND  $fieldName2='".$fieldValue2."' ";
		}
		
		$optionalParameters = array();
		$statement = $dbAdapter->createStatement($sql, $optionalParameters);

		$result = $statement->execute();
		$resultSet = new ResultSet;
		$resultSet->initialize($result);
		$rowset = $resultSet->toArray();

		if(count($rowset)>0) {

			return $rowset[0][$IDfield];
		}
		else
		{
			return 0;
		}
	}
	public function validateduplicatemultiple($tableName,$EDIT_ID,$fnameValPair,$dbAdapter)
	{
		$sql = "select id from $tableName where id !='".$EDIT_ID."' ";
		foreach($fnameValPair as $fieldName => $fieldValue)
		{
			$sql .= " AND   $fieldName =  '$fieldValue' ";
		}
		$optionalParameters = array();
		$statement = $dbAdapter->createStatement($sql, $optionalParameters);

		$result = $statement->execute();
		$resultSet = new ResultSet;
		$resultSet->initialize($result);
		$rowset = $resultSet->toArray();

		if(count($rowset)>0) {

			$result1['recordsTotal'] = count($rowset);
			$result1['DBStatus'] = 'ERR';
		}
		else
		{
			$result1['DBStatus'] = 'OK';
		}

		$result1 = json_encode($result1);
		echo $result1;
		exit;
	}
	public function validateduplicatemultipleCSV($tableName,$EDIT_ID,$fnameValPair,$dbAdapter)
	{
		$sql = "select id from $tableName where id !='".$EDIT_ID."' ";
		foreach($fnameValPair as $fieldName => $fieldValue)
		{
			$sql .= " AND   $fieldName =  '$fieldValue' ";
		}
		$optionalParameters = array();
		$statement = $dbAdapter->createStatement($sql, $optionalParameters);

		$result = $statement->execute();
		$resultSet = new ResultSet;
		$resultSet->initialize($result);
		$rowset = $resultSet->toArray();
		if(count($rowset)>0) {

			return $rowset[0]['id'];
		}
		else
		{
			return 0;
		}

	}
	public function exportDataValidate($string)
	{
		$string = str_replace("\r\n","<br>",$string);
		$string = str_replace(",","~",$string);
		return $string;
	}
	public function importDataValidate($string)
	{
		$string = str_replace("<br>","\r\n",$string);
		$string = str_replace("~",",",$string);
		return $string;
	}
	public function getActiveLocales($dbAdapter)
	{
		$sql = "SELECT * FROM view_locale WHERE status = 'Active' ";
		$optionalParameters = array();
		$statement = $dbAdapter->createStatement($sql, $optionalParameters);

		$result = $statement->execute();
		$resultSet = new ResultSet;
		$resultSet->initialize($result);
		$rowset = $resultSet->toArray();

		return $rowset;
	}
	public function getLocalNameById($dbAdapter,$id)
	{
		$sql = "SELECT name FROM view_locale WHERE id = '".$id."' ORDER BY sequence ASC";
		$optionalParameters = array();
		$statement = $dbAdapter->createStatement($sql, $optionalParameters);

		$result = $statement->execute();
		$resultSet = new ResultSet;
		$resultSet->initialize($result);
		$rowset = $resultSet->toArray();

		return $rowset[0]['name'];
	}
	public function exportCsvData($string,$filename,$config)
	{
		$time = date('YmdHis');
		$filename = $filename."-".$time.".csv";
		$exportFilePath =$config['site_dir_path']['public_dir_path']."exportcsv/".$filename;
		$fp = fopen($exportFilePath,"w+");
		fwrite($fp,$string);
		fclose($fp);
		$result['DBStatus'] = 'OK';
		$result['EXPORTURL'] = $config['sitr_url'].'public/exportcsv/'.$filename;
		$result = json_encode($result);
        echo $result;
        exit;
	}
	
	public function getSingleRecord($ID,$cacheObj,$cacheName,$tableName,$dbAdapter)
	{
		$rowset = array();
		if($cacheObj->hasItem($cacheName) && is_array($cacheObj->getItem($cacheName)))
		{
			$itemObj = $cacheObj->getItem($cacheName);
			$rowset[0] = $itemObj[$ID];
		}
		else
		{
			$projectTable = new TableGateway($tableName, $dbAdapter);
			$rowset = $projectTable->select(array('id' => $iID));
			$rowset = $rowset->toArray();
		}

		return $rowset[0];
	}
	public function getSingleRecord2($fieldName,$fieldValue,$tableName,$dbAdapter)
	{
		$rowset = array();
		
		$projectTable = new TableGateway($tableName, $dbAdapter);
		$rowset = $projectTable->select(array($fieldName => $fieldValue));
		$rowset = $rowset->toArray();

		return $rowset;
	}
}
?>