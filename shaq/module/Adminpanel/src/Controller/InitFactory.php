<?php
namespace Aula_Adminpanel\Controller;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Session\SessionManager;
use Zend\Session\Container;

use Zend\Cache\Storage\Adapter\RedisOptions;
use Zend\Cache\Storage\Adapter\Redis;

use Zend\Cache\Storage\Adapter\MemcachedOptions;
use Zend\Cache\Storage\Adapter\Memcached;

class InitFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $controllerName, array $options = null) {
        if(!class_exists($controllerName)) {
            throw new ServiceNotFoundException("Requested controller name '".$controllerName."' does not exist.");
        }
		
		$sessionManager = $container->get(SessionManager::class);
		$sessionManager->start();
		$sessionContainer = new Container('Aula', $sessionManager);
		
		$config = $container->get('config');
		$redisConfig = $config ['redis'];
		$memcachedOptionConfig = $config ['caches'] ['memcached'] ['adapter'] ['options'] ['servers'];		
		
		$redisOptions = new RedisOptions ();
		$redisOptions->setServer ( array (
				'host' => $redisConfig ["host"],
				'port' => $redisConfig ["port"],
				'timeout' => '30' 
		) );
		
		$redisOptions->setLibOptions ( array (
				\Redis::OPT_SERIALIZER => \Redis::SERIALIZER_PHP 
		) );
		
		$redis = new Redis ( $redisOptions );
		/**********************/
		$MemcachedOptions = new MemcachedOptions ();
		$MemcachedOptions->setServers ($memcachedOptionConfig);
		
		$memcached = new Memcached ( $MemcachedOptions );
		
		if(!strstr($controllerName,"\Login") && !strstr($controllerName,"\Forgotpwd")) {
			if ($sessionManager->isValid() && $sessionContainer->Aula_UID > 0) {}
			else {
				header("location: /adminpanel/login");	
				exit;	
			}	
		}
		return new $controllerName($container->get(AdapterInterface::class),$sessionContainer,$config,$redis,$memcached,$container);
    }

}
?>