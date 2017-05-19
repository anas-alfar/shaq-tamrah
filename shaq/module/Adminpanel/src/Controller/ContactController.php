<?php
namespace Aula_Adminpanel\Controller;

use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Db\Sql\Sql as Sql;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Adapter\AdapterInterface;

class ContactController extends AbstractActionController
{
    private $svAdapter; 
	public function __construct(AdapterInterface $dbAdapter)
    {
        $this->svAdapter = $dbAdapter;
    }
    public function indexAction()
    {
		echo $this->url()->fromRoute('adminpanel/global-dashboard');
		$projectTable = new TableGateway('admin_authorization',$this->svAdapter);
		$rowset = $projectTable->select();
		$rowset = $rowset->toArray();
		print_r($rowset);
		
		
		die();
		return new ViewModel();
    }
}
