<?php
namespace Aula_Adminpanel;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\Router\Http\Regex;
use Zend\ServiceManager\Factory\InvokableFactory;
use Aula_Application\Route\StaticRoute;
use Zend\Db\Adapter\AdapterInterface;

return [
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => Controller\InitFactory::class,
			Controller\LoginController::class => Controller\InitFactory::class,
			Controller\ContactController::class => Controller\InitFactory::class,
			Controller\DashboardController::class => Controller\InitFactory::class,
			Controller\GlobalDashboardController::class => Controller\InitFactory::class,
			Controller\BeneficiariesDashboardController::class => Controller\InitFactory::class,
			Controller\ProjectsDashboardController::class => Controller\InitFactory::class,
			Controller\PaymentsDashboardController::class => Controller\InitFactory::class,
			Controller\AssetsDashboardController::class => Controller\InitFactory::class,
			Controller\PostsDashboardController::class => Controller\InitFactory::class,
			Controller\ConfigurationsController::class => Controller\InitFactory::class,
			Controller\MenuCategoriesController::class => Controller\InitFactory::class,
			Controller\LocalesController::class => Controller\InitFactory::class,
			Controller\TranslationController::class => Controller\InitFactory::class,
			Controller\CountriesController::class => Controller\InitFactory::class,
			Controller\MaritalStatusesController::class => Controller\InitFactory::class,
			Controller\EducationLevelsController::class => Controller\InitFactory::class,
			Controller\MedicalConditionsController::class => Controller\InitFactory::class,
			Controller\DeathReasonsController::class => Controller\InitFactory::class,
			Controller\MediaFilesTypesController::class => Controller\InitFactory::class,
			Controller\CitiesController::class => Controller\InitFactory::class,
			Controller\AssetUnitTypesController::class => Controller\InitFactory::class,
			Controller\AssetStorageTypesController::class => Controller\InitFactory::class,
			Controller\MediaStatusesController::class => Controller\InitFactory::class,
			Controller\MessageTypesController::class => Controller\InitFactory::class,
			Controller\MediaCategoriesController::class => Controller\InitFactory::class,
			Controller\MediaTypesController::class => Controller\InitFactory::class,
			Controller\MessageTemplatesController::class => Controller\InitFactory::class,
			Controller\AssetConditionsController::class => Controller\InitFactory::class,
			Controller\BeneficiaryController::class => Controller\InitFactory::class,
			Controller\BeneficiaryProfileController::class => Controller\InitFactory::class,
			Controller\VolunteerTypesController::class => Controller\InitFactory::class,
			Controller\DisabledTypesController::class => Controller\InitFactory::class,
			Controller\DisabledReasonsController::class => Controller\InitFactory::class,
			Controller\FamilyFlagsController::class => Controller\InitFactory::class,
			Controller\FamilyProfessionsController::class => Controller\InitFactory::class,
			Controller\IncomeTypesController::class => Controller\InitFactory::class,
			Controller\HomeConstructionTypesController::class => Controller\InitFactory::class,
			Controller\HomeContractTypesController::class => Controller\InitFactory::class,
			Controller\BeneficiaryRelationsController::class => Controller\InitFactory::class,
			Controller\SpendingTypesController::class => Controller\InitFactory::class,
			Controller\OrganizationFlagsController::class => Controller\InitFactory::class,
			Controller\OrganizationTypesController::class => Controller\InitFactory::class,
			
			
        ],
    ],
    'router' => [
        'routes' => [
            'adminpanel' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/adminpanel[/]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
				'may_terminate' => true,
				'child_routes' => [
					'contact' => [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'contact[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\ContactController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'dashboard' => [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'dashboard[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\DashboardController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'global-dashboard' => [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'global-dashboard[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\GlobalDashboardController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'beneficiaries-dashboard' => [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'beneficiaries-dashboard[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\BeneficiariesDashboardController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'projects-dashboard' => [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'projects-dashboard[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\ProjectsDashboardController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'payments-dashboard' => [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'payments-dashboard[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\PaymentsDashboardController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'assets-dashboard' => [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'assets-dashboard[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\AssetsDashboardController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'posts-dashboard' => [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'posts-dashboard[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\PostsDashboardController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'configurations' => [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'configurations[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\ConfigurationsController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'menu-categories' => [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'menu-categories[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\MenuCategoriesController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'marital-statuses' => 	 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'marital-statuses[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\MaritalStatusesController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'education-levels' =>    [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'education-levels[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\EducationLevelsController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'medical-conditions' =>  [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'medical-conditions[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\MedicalConditionsController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'death-reasons' => 		 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'death-reasons[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\DeathReasonsController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'media-files-types' => 	 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'media-files-types[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\MediaFilesTypesController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'cities' =>              [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'cities[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\CitiesController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'asset-unit-types' => 	 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'asset-unit-types[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\AssetUnitTypesController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'asset-storage-types' => [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'asset-storage-types[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\AssetStorageTypesController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'media-statuses' =>		 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'media-statuses[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\MediaStatusesController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'message-types' => 		 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'message-types[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\MessageTypesController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'media-categories' => 	 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'media-categories[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\MediaCategoriesController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'media-types' => 	 	 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'media-types[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\MediaTypesController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'message-templates' => 	 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'message-templates[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\MessageTemplatesController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'asset-conditions' => 	 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'asset-conditions[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\AssetConditionsController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'locales' => [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'locales[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\LocalesController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'translation' => [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'translation[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\TranslationController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'countries' => [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'countries[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\CountriesController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'beneficiary' => 	 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'beneficiary[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\BeneficiaryController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'beneficiary-profile' => 	 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'beneficiary-profile[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\BeneficiaryProfileController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'volunteer-types' => 	 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'volunteer-types[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\VolunteerTypesController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'disabled-types' => 	 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'disabled-types[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\DisabledTypesController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'disabled-reasons' => 	 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'disabled-reasons[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\DisabledReasonsController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'family-flags' => 	 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'family-flags[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\FamilyFlagsController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'family-professions' => 	 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'family-professions[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\FamilyProfessionsController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'income-types' => 	 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'income-types[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\IncomeTypesController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'home-construction-types' => 	 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'home-construction-types[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\HomeConstructionTypesController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'home-contract-types' => 	 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'home-contract-types[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\HomeContractTypesController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'beneficiary-relations' => 	 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'beneficiary-relations[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\BeneficiaryRelationsController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					
					'spending-types' => 	 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'spending-types[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\SpendingTypesController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					
					'organization-flags' => 	 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'organization-flags[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\OrganizationFlagsController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'organization-types' => 	 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'organization-types[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\OrganizationTypesController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					
					'login' => [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'login[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\LoginController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					
					
					
				],
            ],
			
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'aula_adminpanel/index/index' => __DIR__ . '/../view/adminpanel/index/index.phtml',
			
			/* for contact controller */
			'aula_adminpanel/contact/index' => __DIR__ . '/../view/adminpanel/contact/index.phtml',
			'aula_adminpanel/dashboard/index' => __DIR__ . '/../view/adminpanel/dashboard/index.phtml',
			'aula_adminpanel/global-dashboard/index' => __DIR__ . '/../view/adminpanel/dashboard/global-dashboard.phtml',
			'aula_adminpanel/beneficiaries-dashboard/index' => __DIR__ . '/../view/adminpanel/dashboard/beneficiaries-dashboard.phtml',
			'aula_adminpanel/projects-dashboard/index' => __DIR__ . '/../view/adminpanel/dashboard/projects-dashboard.phtml',
			'aula_adminpanel/payments-dashboard/index' => __DIR__ . '/../view/adminpanel/dashboard/payments-dashboard.phtml',
			'aula_adminpanel/assets-dashboard/index' => __DIR__ . '/../view/adminpanel/dashboard/assets-dashboard.phtml',
			'aula_adminpanel/posts-dashboard/index' => __DIR__ . '/../view/adminpanel/dashboard/posts-dashboard.phtml',
			'aula_adminpanel/configurations/index' => __DIR__ . '/../view/adminpanel/settings/general/configurations/index.phtml',
			'aula_adminpanel/menu-categories/index' => __DIR__ . '/../view/adminpanel/settings/general/menu-categories/index.phtml',
			'aula_adminpanel/marital-statuses/index' => __DIR__ . '/../view/adminpanel/settings/general/marital-statuses/index.phtml',
			'aula_adminpanel/education-levels/index' => __DIR__ . '/../view/adminpanel/settings/general/education-levels/index.phtml',
			'aula_adminpanel/medical-conditions/index' => __DIR__ . '/../view/adminpanel/settings/general/medical-conditions/index.phtml',
			'aula_adminpanel/death-reasons/index' => __DIR__ . '/../view/adminpanel/settings/general/death-reasons/index.phtml',
			'aula_adminpanel/media-files-types/index' => __DIR__ . '/../view/adminpanel/settings/general/media-files-types/index.phtml',
			'aula_adminpanel/locales/index' => __DIR__ . '/../view/adminpanel/settings/general/locales/index.phtml',
			'aula_adminpanel/translation/index' => __DIR__ . '/../view/adminpanel/settings/general/translation/index.phtml',
			'aula_adminpanel/countries/index' => __DIR__ . '/../view/adminpanel/settings/general/countries/index.phtml',
			'aula_adminpanel/cities/index' => __DIR__ . '/../view/adminpanel/settings/general/cities/index.phtml',
			'aula_adminpanel/asset-unit-types/index' => __DIR__ . '/../view/adminpanel/settings/general/asset-unit-types/index.phtml',
			'aula_adminpanel/asset-storage-types/index' => __DIR__ . '/../view/adminpanel/settings/general/asset-storage-types/index.phtml',
			'aula_adminpanel/media-statuses/index' => __DIR__ . '/../view/adminpanel/settings/general/media-statuses/index.phtml',
			'aula_adminpanel/message-types/index' => __DIR__ . '/../view/adminpanel/settings/general/message-types/index.phtml',
			'aula_adminpanel/media-categories/index' => __DIR__ . '/../view/adminpanel/settings/general/media-categories/index.phtml',
			'aula_adminpanel/media-types/index' => __DIR__ . '/../view/adminpanel/settings/general/media-types/index.phtml',
			'aula_adminpanel/message-templates/index' => __DIR__ . '/../view/adminpanel/settings/general/message-templates/index.phtml',
			'aula_adminpanel/asset-conditions/index' => __DIR__ . '/../view/adminpanel/settings/general/asset-conditions/index.phtml',
			'aula_adminpanel/beneficiary/index' => __DIR__ . '/../view/adminpanel/settings/general/beneficiary/index.phtml',
			'aula_adminpanel/beneficiary-profile/index' => __DIR__ . '/../view/adminpanel/settings/general/beneficiary-profile/index.phtml',
			'aula_adminpanel/volunteer-types/index' => __DIR__ . '/../view/adminpanel/settings/general/volunteer-types/index.phtml',
			'aula_adminpanel/disabled-types/index' => __DIR__ . '/../view/adminpanel/settings/general/disabled-types/index.phtml',
			'aula_adminpanel/disabled-reasons/index' => __DIR__ . '/../view/adminpanel/settings/general/disabled-reasons/index.phtml',
			'aula_adminpanel/family-flags/index' => __DIR__ . '/../view/adminpanel/settings/general/family-flags/index.phtml',
			'aula_adminpanel/family-professions/index' => __DIR__ . '/../view/adminpanel/settings/general/family-professions/index.phtml',
			'aula_adminpanel/income-types/index' => __DIR__ . '/../view/adminpanel/settings/general/income-types/index.phtml',
			'aula_adminpanel/home-construction-types/index' => __DIR__ . '/../view/adminpanel/settings/general/home-construction-types/index.phtml',
			'aula_adminpanel/home-contract-types/index' => __DIR__ . '/../view/adminpanel/settings/general/home-contract-types/index.phtml',
			'aula_adminpanel/beneficiary-relations/index' => __DIR__ . '/../view/adminpanel/settings/general/beneficiary-relations/index.phtml',
			'aula_adminpanel/spending-types/index' => __DIR__ . '/../view/adminpanel/settings/general/spending-types/index.phtml',
			'aula_adminpanel/organization-flags/index' => __DIR__ . '/../view/adminpanel/settings/general/organization-flags/index.phtml',
			'aula_adminpanel/organization-types/index' => __DIR__ . '/../view/adminpanel/settings/general/organization-types/index.phtml',
			
			'aula_adminpanel/login/index' => '/../view/adminpanel/admin-layout/login-layout.phtml',
			
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
	'module_layouts' => [
      'Aula_Adminpanel' => '/admin-layout/layout.phtml',
     ],
];
