<?php
namespace Aula_Adminpanel\Controller;

use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Db\Sql\Sql as Sql;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\ResultSet;

use Zend\Db\Adapter\AdapterInterface;

class LoginController extends AbstractActionController
{
	private $dbAdapter;
	private $sessionContainer;
	protected $request;
	private $config;
	protected static $Aula_UID;
	public function __construct(AdapterInterface $dbAdapter,$sessionContainer,$config,$redis)
    {
        $this->dbAdapter = $dbAdapter;
		$this->sessionContainer = $sessionContainer;
		self::$Aula_UID = $this->sessionContainer->Aula_UID;
		$this->request = $this->getRequest();
		$this->config = $config;
    }
    public function indexAction()
    {
		//echo self::$Aula_UID;
    }
	public function dologinAction()
	{
		$aData = json_decode($this->request->getPost("FORM_DATA"));
		$aData = (array)$aData;
		
		$AES_ED_KEY = $this->config['db']['AES_ED_KEY'];
		$encoded = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($AES_ED_KEY), $aData['login_password'], MCRYPT_MODE_CBC, md5(md5($AES_ED_KEY))));
		
		$projectTable = new TableGateway('admin_authorization',$this->dbAdapter);
		$rowset = $projectTable->select(['username' => $aData['login_name'],'password' => $encoded]);
		$rowset = $rowset->toArray();
		if(count($rowset) > 0)
		{
			if($rowset[0]['username'] ==  $aData['login_name'] && $rowset[0]['password'] ==  $encoded)
			{
				if($rowset[0]['status'] ==  "Active")
				{
					$this->sessionContainer->Aula_UID = $rowset[0]['id'];
					$this->sessionContainer->Aula_OrgID = $rowset[0]['id'];
					$this->sessionContainer->Aula_OwnerOrgID = $rowset[0]['id'];
					$this->sessionContainer->Aula_OwnerOrgUserID = $rowset[0]['id'];
								
								$masterData = array();
								$masterData['last_login_date'] 	= date('Y-m-d H:i:s');
								$masterData['last_login_ip'] 	= $_SERVER['REMOTE_ADDR'];
								$projectTable->update($masterData,array("id=".$this->sessionContainer->Aula_UID));
										
					$returnResult['DBStatus'] = 'OK';
				}
				else
				{
					$returnResult['DBStatus'] = 'ERR';
					$returnResult['DBMsg'] = 'Your account is not active yet.';
				}
			}
			else
			{
				$returnResult['DBStatus'] = 'ERR';
				$returnResult['DBMsg'] = 'Invalid username or password.';
			}
		}
		else
		{
			$returnResult['DBStatus'] = 'ERR';
			$returnResult['DBMsg'] = 'Invalid username or password.';
		}		
		$returnResult = json_encode($returnResult);
		echo $returnResult;
		die();
	}
	public function logoutAction()
	{
		unset($this->sessionContainer->Aula_UID);
		//$redirectUrl = $this->url()->fromRoute('adminpanel/login',['action' =>  'logout']);
		$redirectUrl = $this->url()->fromRoute('adminpanel/login');
		header("Location: ".$redirectUrl);
		die();
	}
}
