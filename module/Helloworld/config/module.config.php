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
            }
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
            }
        ),
    ),
    /* Define view helpers
    'view_helpers' => array(
		'invokables' => array(
			'displayCurrentDate'
				=> 'Helloworld\View\Helper\DisplayCurrentDate'
		)
	)
    */
);