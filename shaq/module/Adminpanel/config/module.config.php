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
			Controller\OrganizationBranchesController::class => Controller\InitFactory::class,
			Controller\OrganizationController::class => Controller\InitFactory::class,
			Controller\OrganizationUserController::class => Controller\InitFactory::class,
			Controller\OrganizationUserPositionController::class => Controller\InitFactory::class,
			Controller\BranchCommitteeController::class => Controller\InitFactory::class,
			Controller\AssetsLocationsController::class => Controller\InitFactory::class,
			Controller\BranchCommitteeUserController::class => Controller\InitFactory::class,
			Controller\PostTypesController::class => Controller\InitFactory::class,
			Controller\PostCategoriesController::class => Controller\InitFactory::class,
			Controller\PostAuthorController::class => Controller\InitFactory::class,
			Controller\ProjectCategoriesController::class => Controller\InitFactory::class,
			Controller\ProjectTypesController::class => Controller\InitFactory::class,
			Controller\ProjectMasjedTypeController::class => Controller\InitFactory::class,
			Controller\ProjectMasjedTypeDetailsController::class => Controller\InitFactory::class,
			Controller\ProjectMasjedConstructionTypeController::class => Controller\InitFactory::class,
			Controller\ProjectMasjedFurnitureTypeController::class => Controller\InitFactory::class,
			Controller\PaymentProcessingFeesController::class => Controller\InitFactory::class,
			Controller\PaymentMethodController::class => Controller\InitFactory::class,
			Controller\PaymentMethodConfigurationController::class => Controller\InitFactory::class,
			Controller\CurrenciesController::class => Controller\InitFactory::class,
			Controller\CurrencyExchangeRateController::class => Controller\InitFactory::class,
			Controller\GlAccountTypeController::class => Controller\InitFactory::class,
			Controller\GlAccountController::class => Controller\InitFactory::class,
			Controller\TransactionTypeController::class => Controller\InitFactory::class,
			Controller\AdminAuthorizationRoleController::class => Controller\InitFactory::class,
			Controller\AuthorizationResourceController::class => Controller\InitFactory::class,
			Controller\AdminAuthorizationRuleController::class => Controller\InitFactory::class,
			Controller\MenuController::class => Controller\InitFactory::class,
			Controller\AssetController::class => Controller\InitFactory::class,
			Controller\AssetTypeController::class => Controller\InitFactory::class,
			Controller\OrganizationAssetController::class => Controller\InitFactory::class,
			Controller\AuthorizationOrganizationRelationRoleController::class => Controller\InitFactory::class,
			Controller\GroupController::class => Controller\InitFactory::class,
			Controller\BeneficiaryProfileAssetReceivedController::class => Controller\InitFactory::class,
			Controller\BeneficiaryProfileAssetRequiredController::class => Controller\InitFactory::class,
			Controller\DonationController::class => Controller\InitFactory::class,
			Controller\GalleryController::class => Controller\InitFactory::class,
			Controller\MessageController::class => Controller\InitFactory::class,
			Controller\ResearchNotesController::class => Controller\InitFactory::class,
			Controller\DonorController::class => Controller\InitFactory::class,
			Controller\AdvanceSearchFormController::class => Controller\InitFactory::class,
			
			
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
					
					'organization-user' => 	 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'organization-user[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\OrganizationUserController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					
					'organization-user-position' => 	 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'organization-user-position[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\OrganizationUserPositionController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					
					'branch-committee' => 	 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'branch-committee[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\BranchCommitteeController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'assets-locations' => 	 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'assets-locations[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\AssetsLocationsController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'branch-committee-user' => 	 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'branch-committee-user[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\BranchCommitteeUserController::class,
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
					'organization-branches' => 	 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'organization-branches[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\OrganizationBranchesController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'organization' => 	 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'organization[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\OrganizationController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'post-types' => 	 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'post-types[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\PostTypesController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'post-categories' => 	 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'post-categories[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\PostCategoriesController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'post-author' => 	 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'post-author[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\PostAuthorController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'project-categories' => 	 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'project-categories[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\ProjectCategoriesController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'project-types' => 	 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'project-types[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\ProjectTypesController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'project-masjed-type' => 	 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'project-masjed-type[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\ProjectMasjedTypeController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'project-masjed-type-details' => 	 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'project-masjed-type-details[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\ProjectMasjedTypeDetailsController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'project-masjed-construction-type' => 	 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'project-masjed-construction-type[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\ProjectMasjedConstructionTypeController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'project-masjed-furniture-type' => 	 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'project-masjed-furniture-type[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\ProjectMasjedFurnitureTypeController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'payment-processing-fees' => 	 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'payment-processing-fees[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\PaymentProcessingFeesController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'payment-method' => 	 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'payment-method[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\PaymentMethodController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'payment-method-configuration' => 	 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'payment-method-configuration[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\PaymentMethodConfigurationController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'currencies' => 	 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'currencies[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\CurrenciesController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'currency-exchange-rate' => 	 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'currency-exchange-rate[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\CurrencyExchangeRateController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'gl-account-type' => 	 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'gl-account-type[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\GlAccountTypeController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'gl-account' => 	 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'gl-account[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\GlAccountController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'transaction-type' => 	 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'transaction-type[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\TransactionTypeController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'admin-authorization-role' => 	 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'admin-authorization-role[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\AdminAuthorizationRoleController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'authorization-resource' => 	 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'authorization-resource[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\AuthorizationResourceController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'admin-authorization-rule' => 	 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'admin-authorization-rule[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\AdminAuthorizationRuleController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'menu' => 	 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'menu[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\MenuController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'asset' => 	 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'asset[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\AssetController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'asset-type' => 	 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'asset-type[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\AssetTypeController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					
					'organization-asset' => 	 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'organization-asset[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\OrganizationAssetController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					
					'authorization-organization-relation-role' => 	 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'authorization-organization-relation-role[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\AuthorizationOrganizationRelationRoleController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					
					'group' => 	 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'group[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\GroupController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'beneficiary-profile-asset-received' => 	 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'beneficiary-profile-asset-received[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\BeneficiaryProfileAssetReceivedController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'beneficiary-profile-asset-required' => 	 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'beneficiary-profile-asset-required[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\BeneficiaryProfileAssetRequiredController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'donation' => 	 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'donation[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\DonationController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'gallery' => 	 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'gallery[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\GalleryController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'message' => 	 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'message[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\MessageController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'research-notes' => 	 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'research-notes[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\ResearchNotesController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'donor' => 	 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'donor[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\DonorController::class,
								'action'     => 'index',
							],
						],
						'may_terminate' => true,
					],
					'advance-search-form' => 	 [
						'type'    => Segment::class,
						'options' => [
							'route'    => 'advance-search-form[/:action]',
							 'constraints' => [
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							 ],

							'defaults' => [
								'controller' => Controller\AdvanceSearchFormController::class,
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
			'aula_adminpanel/organization-user/index' => __DIR__ . '/../view/adminpanel/settings/general/organization-user/index.phtml',
			'aula_adminpanel/organization-user-position/index' => __DIR__ . '/../view/adminpanel/settings/general/organization-user-position/index.phtml',
			'aula_adminpanel/branch-committee/index' => __DIR__ . '/../view/adminpanel/settings/general/branch-committee/index.phtml',
			'aula_adminpanel/assets-locations/index' => __DIR__ . '/../view/adminpanel/settings/general/assets-locations/index.phtml',
			'aula_adminpanel/branch-committee-user/index' => __DIR__ . '/../view/adminpanel/settings/general/branch-committee-user/index.phtml',
			'aula_adminpanel/organization-flags/index' => __DIR__ . '/../view/adminpanel/settings/general/organization-flags/index.phtml',
			'aula_adminpanel/organization-types/index' => __DIR__ . '/../view/adminpanel/settings/general/organization-types/index.phtml',
			'aula_adminpanel/organization-branches/index' => __DIR__ . '/../view/adminpanel/settings/general/organization-branches/index.phtml',
			'aula_adminpanel/organization/index' => __DIR__ . '/../view/adminpanel/settings/general/organization/index.phtml',
			'aula_adminpanel/categories/index' => __DIR__ . '/../view/adminpanel/settings/general/categories/index.phtml',
			'aula_adminpanel/post-types/index' => __DIR__ . '/../view/adminpanel/settings/general/post-types/index.phtml',
			'aula_adminpanel/post-categories/index' => __DIR__ . '/../view/adminpanel/settings/general/post-categories/index.phtml',
			'aula_adminpanel/post-author/index' => __DIR__ . '/../view/adminpanel/settings/general/post-author/index.phtml',
			'aula_adminpanel/project-categories/index' => __DIR__ . '/../view/adminpanel/settings/general/project-categories/index.phtml',
			'aula_adminpanel/project-types/index' => __DIR__ . '/../view/adminpanel/settings/general/project-types/index.phtml',
			'aula_adminpanel/project-masjed-type/index' => __DIR__ . '/../view/adminpanel/settings/general/project-masjed-type/index.phtml',
			'aula_adminpanel/project-masjed-type-details/index' => __DIR__ . '/../view/adminpanel/settings/general/project-masjed-type-details/index.phtml',
			'aula_adminpanel/project-masjed-construction-type/index' => __DIR__ . '/../view/adminpanel/settings/general/project-masjed-construction-type/index.phtml',
			'aula_adminpanel/project-masjed-furniture-type/index' => __DIR__ . '/../view/adminpanel/settings/general/project-masjed-furniture-type/index.phtml',
			'aula_adminpanel/payment-processing-fees/index' => __DIR__ . '/../view/adminpanel/settings/general/payment-processing-fees/index.phtml',
			'aula_adminpanel/payment-method/index' => __DIR__ . '/../view/adminpanel/settings/general/payment-method/index.phtml',
			'aula_adminpanel/payment-method-configuration/index' => __DIR__ . '/../view/adminpanel/settings/general/payment-method-configuration/index.phtml',
			'aula_adminpanel/currencies/index' => __DIR__ . '/../view/adminpanel/settings/general/currencies/index.phtml',
			'aula_adminpanel/currency-exchange-rate/index' => __DIR__ . '/../view/adminpanel/settings/general/currency-exchange-rate/index.phtml',
			'aula_adminpanel/gl-account-type/index' => __DIR__ . '/../view/adminpanel/settings/general/gl-account-type/index.phtml',
			'aula_adminpanel/gl-account/index' => __DIR__ . '/../view/adminpanel/settings/general/gl-account/index.phtml',
			'aula_adminpanel/transaction-type/index' => __DIR__ . '/../view/adminpanel/settings/general/transaction-type/index.phtml',
			'aula_adminpanel/admin-authorization-role/index' => __DIR__ . '/../view/adminpanel/settings/general/admin-authorization-role/index.phtml',
			'aula_adminpanel/authorization-resource/index' => __DIR__ . '/../view/adminpanel/settings/general/authorization-resource/index.phtml',
			'aula_adminpanel/admin-authorization-rule/index' => __DIR__ . '/../view/adminpanel/settings/general/admin-authorization-rule/index.phtml',
			'aula_adminpanel/menu/index' => __DIR__ .'/../view/adminpanel/settings/general/menu/index.phtml',
			'aula_adminpanel/asset/index' => __DIR__ .'/../view/adminpanel/settings/general/asset/index.phtml',
			'aula_adminpanel/asset-type/index' => __DIR__ .'/../view/adminpanel/settings/general/asset-type/index.phtml',
			'aula_adminpanel/organization-asset/index' => __DIR__ .'/../view/adminpanel/settings/general/organization-asset/index.phtml',
			'aula_adminpanel/authorization-organization-relation-role/index' => __DIR__ .'/../view/adminpanel/settings/general/authorization-organization-relation-role/index.phtml',
			'aula_adminpanel/group/index' => __DIR__ .'/../view/adminpanel/settings/general/group/index.phtml',
			'aula_adminpanel/beneficiary-profile-asset-received/index' => __DIR__ .'/../view/adminpanel/settings/general/beneficiary-profile-asset-received/index.phtml',
			'aula_adminpanel/beneficiary-profile-asset-required/index' => __DIR__ .'/../view/adminpanel/settings/general/beneficiary-profile-asset-required/index.phtml',
			'aula_adminpanel/donation/index' => __DIR__ .'/../view/adminpanel/settings/general/donation/index.phtml',
			'aula_adminpanel/gallery/index' => __DIR__ .'/../view/adminpanel/settings/general/gallery/index.phtml',
			'aula_adminpanel/message/index' => __DIR__ .'/../view/adminpanel/settings/general/message/index.phtml',
			'aula_adminpanel/research-notes/index' => __DIR__ .'/../view/adminpanel/settings/general/research-notes/index.phtml',
			'aula_adminpanel/donor/index' => __DIR__ .'/../view/adminpanel/settings/general/donor/index.phtml',
			'aula_adminpanel/advance-search-form/index' => __DIR__ .'/../view/adminpanel/settings/general/advance-search-form/index.phtml',
			
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
