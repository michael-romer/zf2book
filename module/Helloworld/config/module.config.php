<?php
return array(
   	'view_manager' => array(
       	'template_path_stack' => array(
           	__DIR__ . '/../view'
       	)
   	),
    'router' => array(
        'routes' => array(
            'sayhello' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/sayhello',
                    'defaults' => array(
                        'controller' => 'Helloworld\Controller\Index',
                        'action'     => 'index',
                    )
                )
            ),
            'login' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/login',
                    'defaults' => array(
                        'controller'    => 'Helloworld\Controller\Auth',
                        'action'        => 'login',
                    ),
                ),
            ),
            'logout' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/logout',
                    'defaults' => array(
                        'controller'    => 'Helloworld\Controller\Auth',
                        'action'        => 'logout',
                    ),
                ),
            ),
            'restful-products' => array(
           		'type'    => 'Literal',
           		'options' => array(
           			'route'    => '/rest/product',
           			'defaults' => array(
           				'controller'    => 'Helloworld\Controller\Product'
           			),
           		),
           	)
        )
    ),
    'controllers' => array(
        /* Using the direct instantiation approach
        'invokables' => array(
            'Helloworld\Controller\Index'
                => 'Helloworld\Controller\IndexController'
        )
        */
        /* Using the factory instantiation approach
        'factories' => array(
            'Helloworld\Controller\Index'
                => 'Helloworld\Controller\IndexControllerFactory'
        )
        */
        /* Using a callback factory instantiation approach */
        'factories' => array(
            'Helloworld\Controller\Index' => function($serviceLocator) {
                $ctr = new Helloworld\Controller\IndexController();

                $ctr->setGreetingService(
                    $serviceLocator->getServiceLocator()
                        ->get('greetingService')
                );

                return $ctr;
            },
            'Helloworld\Controller\Auth' => 'Helloworld\Controller\AuthControllerFactory'
        )
    ),
    'service_manager' => array(
        'invokables' => array(
            /* Using the direct instantiation approach
            'greetingService' => 'Helloworld\Service\GreetingService',
            */
            'loggingService' => 'Helloworld\Service\LoggingService'
        ),
        /* Using the factory instantiation approach */
        'factories' => array(
            'greetingService' => 'Helloworld\Service\GreetingServiceFactory',
            'Zend\Db\Adapter\Adapter' => function ($sm) {
                $config = $sm->get('Config');
                $dbParams = $config['dbParams'];

                return new Zend\Db\Adapter\Adapter(array(
                    'driver'    => 'pdo',
                    'dsn'       =>
                        'mysql:dbname='.$dbParams['database']
                        .';host='.$dbParams['hostname'],
                    'database'  => $dbParams['database'],
                    'username'  => $dbParams['username'],
                    'password'  => $dbParams['password'],
                    'hostname'  => $dbParams['hostname'],
                ));
            },
            'Helloworld\Mapper\Host' => function ($sm) {
                return new \Helloworld\Mapper\Host(
                    $sm->get('Zend\Db\Adapter\Adapter')
                );
            },
            'Helloworld\Service\AuthService' => 'Helloworld\Service\AuthServiceFactory'
        ),
    ),
    'console' => array(
        'router' => array(
            'routes' => array(
                'date' => array(
                    'options' => array(
                        'route'    => 'show date',
                        'defaults' => array(
                            'controller' => 'Helloworld\Controller\Index',
                            'action'     => 'date'
                        )
                    )
                )
            )
        )
    )
    /* Define view helpers
    'view_helpers' => array(
		'invokables' => array(
			'displayCurrentDate'
				=> 'Helloworld\View\Helper\DisplayCurrentDate'
		)
	)
    */
);