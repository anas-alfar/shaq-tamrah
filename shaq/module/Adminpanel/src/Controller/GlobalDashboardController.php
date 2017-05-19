<?php
namespace Aula_Adminpanel\Controller;

use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Db\Sql\Sql as Sql;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Adapter\AdapterInterface;

class GlobalDashboardController extends AbstractActionController
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
		/*if ($this->redisCache->hasItem ( 'custom_key' )) {
			echo $this->redisCache->getItem('custom_key'); 
			echo "in if"; die();
		}else{
			$this->redisCache->setItem('custom_key', 'Custom Value');
			echo $this->redisCache->getItem('custom_key');
			echo "in else"; die();
		}*/
		
		/*if ($this->memCached->hasItem ( 'custom_key1' )) {
			echo $this->memCached->getItem('custom_key1'); 
			echo "in if"; die();
		}else{
			$this->memCached->setItem('custom_key1', 'Custom Value');
			echo $this->memCached->getItem('custom_key1');
			echo "in else"; die();
		}*/
		
		
		return new ViewModel();
    }
}
