<?php 
namespace Aula_Adminpanel;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Session\SessionManager;
use Zend\Session\Container;

class Module
{
    const VERSION = '3.0.3-dev';

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
	public function getControllerPluginConfig() {
        return array(
            'invokables' => array(
                'AdminfunctionsPlugin' => 'Aula_Adminpanel\Controller\Plugin\AdminfunctionsPlugin',
            )
        );
    }
}
