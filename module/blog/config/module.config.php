<?php
/**
 * Created by PhpStorm.
 * User: arman
 * Date: 30/12/2018
 * Time: 16:45
 */

namespace Blog;

use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Zend\Router\Http\Literal;

return [
    'controllers' => [
        'factories' => [
            #Controller\BlogController::class => InvokableFactory::class
        ]
    ],
    'router' => [
        'routes' => [
            'admin-blog' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/admin'
                ],
                'may_terminate' => false,
                'child_routes' => [
                    'post' => [
                        'type' => 'segment',
                        'options' => [
                            'route' => '/blog[/:action[/:id]]',
                            'constraints' => [
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '[0-9]+',
                            ],
                            'defaults' => [
                                'controller' => Controller\BlogController::class,
                                'action' => 'index'
                            ]
                        ]
                    ],
                ]
            ],
            'site-post' => [
                'type' => 'segment',
                'options' => [
                    'route' => '/post[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\PostController::class,
                        'action' => 'index'
                    ]
                ]
            ],
        ]
    ],
    'view_manager' => [
        'template_path_stack' => [
            'blog' => __DIR__ . "/../view"
        ]
    ],
    'doctrine' => [
        'driver' => [
            'Blog_driver' => [
                'class' => AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [
                    __DIR__ . '/../src/Entity'
                ]
            ],
            'orm_default' => [
                'drivers' => [
                    'Blog\Entity' => 'Blog_driver'
                ]
            ]
        ],
        'fixtures' => [
            'BlogFixture' => __DIR__ . '/../src/Fixture'
        ]
    ]
];