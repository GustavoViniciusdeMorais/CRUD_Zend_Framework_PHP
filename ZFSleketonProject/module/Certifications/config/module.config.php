<?php
/**
 * Created by PhpStorm.
 * User: Cliente
 * Date: 23/08/2018
 * Time: 14:37
 */

namespace Certifications;

use Certifications\Model\CertificationsCommandInterface;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    // Add this section:
    'service_manager' => [
        'aliases' => [
            //Model\CertificationsRepositoryInterface::class => Model\CertificationsRepository::class,
            Model\CertificationsRepositoryInterface::class => Model\ZendDbSqlRepository::class,
            Model\CertificationsCommandInterface::class => Model\ZendDbSqlCommand::class,
        ],
        'factories' => [
            Model\CertificationsRepository::class => InvokableFactory::class,
            Model\ZendDbSqlRepository::class => Factory\ZendDbSqlRepositoryFactory::class,
            Model\CertificationCommand::class => InvokableFactory::class,
            Model\ZendDbSqlCommand::class => Factory\ZendDbSqlCommandFactory::class,
        ],
    ],
    'controllers' => [
        'factories' => [
            // Update the following line:
            Controller\ListController::class => Factory\ListControllerFactory::class,
            Controller\WriteController::class => Factory\WriteControllerFactory::class,
            Controller\DeleteController::class => Factory\DeleteControllerFactory::class,
        ],
    ],
    // This lines opens the configuration for the RouteManager
    'router' => [
        // Open configuration for all possible routes
        'routes' => [
            // Define a new route called "blog"
            'certifications' => [
                // Define a "literal" route type:
                'type' => Literal::class,
                // Configure the route itself
                'options' => [
                    // Listen to "/blog" as uri:
                    'route' => '/certifications',
                    // Define default controller and action to be called when
                    // this route is matched
                    'defaults' => [
                        'controller' => Controller\ListController::class,
                        'action'     => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes'  => [
                    'detail' => [
                        'type' => Segment::class,
                        'options' => [
                            'route'    => '/:id',
                            'defaults' => [
                                'action' => 'detail',
                            ],
                            'constraints' => [
                                'id' => '[1-9]\d*',
                            ],
                        ],
                    ],
                    // Add the following route:
                    'add' => [
                        'type' => Literal::class,
                        'options' => [
                            'route'    => '/add',
                            'defaults' => [
                                'controller' => Controller\WriteController::class,
                                'action'     => 'add',
                            ],
                        ],
                    ],
                    'edit' => [
                        'type' => Segment::class,
                        'options' => [
                            'route'    => '/edit/:id',
                            'defaults' => [
                                'controller' => Controller\WriteController::class,
                                'action'     => 'edit',
                            ],
                            'constraints' => [
                                'id' => '[1-9]\d*',
                            ],
                        ],
                    ],
                    'delete' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/delete/:id',
                            'defaults' => [
                                'controller' => Controller\DeleteController::class,
                                'action'     => 'delete',
                            ],
                            'constraints' => [
                                'id' => '[1-9]\d*',
                            ],
                        ],
                    ],
                ],

            ],
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];