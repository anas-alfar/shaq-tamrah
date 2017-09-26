<?php
return [
    'dependencies' => [
        'factories' => [
            Zend\Db\Adapter\Adapter::class => Zend\Db\Adapter\AdapterServiceFactory::class,
        ],
		'abstract_factories' => [
			Zend\Cache\Service\StorageCacheAbstractServiceFactory::class
		]
    ],
];
?>