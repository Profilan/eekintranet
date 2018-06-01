<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'ProUser\Controller\User' => 'ProUser\Controller\UserController',
            'ProUser\Controller\Department' => 'ProUser\Controller\DepartmentController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'pro-user' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/user[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'ProUser\Controller\User',
                        'action'     => 'index',
                    ),
                ),
            ),
            'pro-department' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/department[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'ProUser\Controller\Department',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'ProUser' => __DIR__ . '/../view',
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            'prouser_entities' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/ProUser/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'ProUser\Entity' => 'prouser_entities'
                )
            )
        )
    ),
);
