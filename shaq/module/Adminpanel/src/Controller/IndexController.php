<?php
namespace Aula_Adminpanel\Controller;

use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Db\Sql\Sql as Sql;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Adapter\AdapterInterface;

class IndexController extends AbstractActionController
{
	private $dbAdapter; 
	public function __construct(AdapterInterface $dbAdapter)
    {
        $this->dbAdapter = $dbAdapter;
    }
    public function indexAction()
    {
		$projectTable = new TableGateway('admin_authorization',$this->dbAdapter);
		$rowset = $projectTable->select(['id' => 1]);
		$rowset = $rowset->toArray();
		/*print_r($rowset);		
		
		die();*/
		return new ViewModel();
    }
}
