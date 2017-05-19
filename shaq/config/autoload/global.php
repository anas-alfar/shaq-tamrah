<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

/*return [
    // ...
];*/

use Zend\Db\Adapter\AdapterAbstractServiceFactory;
use Zend\Session\Storage\SessionArrayStorage;
use Zend\Session\Validator\RemoteAddr;
use Zend\Session\Validator\HttpUserAgent;
use Zend\Session\SessionManager;
use Zend\Session\Container;
return [
	'db' => [
        'driver'   => 'Pdo',
        'dsn'      => 'pgsql:host=localhost;port=5432;',
        'database' => 'shaq-tamrah-db',
        'user'     => 'root',
        'password' => 'ShaqPwd@2017-aprl'
    ],
    'service_manager' => [
        'abstract_factories' => [
            AdapterAbstractServiceFactory::class,
			Zend\Cache\Service\StorageCacheAbstractServiceFactory::class
        ],		
		'factories' => [
			Zend\Db\Adapter\Adapter::class => Zend\Db\Adapter\AdapterServiceFactory::class,
		],
    ],
	'session_config' => [
        // Session cookie will expire in 1 hour.
        //'cookie_lifetime' => 60*60*1,     
        // Session data will be stored on server maximum for 30 days.
        //'gc_maxlifetime'     => 60*60*24*30, 
    ],
    // Session manager configuration.
    'session_manager' => [
        // Session validators (used for security).
        'validators' => [
            RemoteAddr::class,
            HttpUserAgent::class,
        ]
    ],
    // Session storage configuration.
    'session_storage' => [
        'type' => SessionArrayStorage::class
    ],
];

