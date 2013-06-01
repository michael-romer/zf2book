<?php
namespace Helloworld;

use Zend\ModuleManager\ModuleManager;
use Zend\ModuleManager\ModuleEvent;
use Zend\Console\Adapter\AdapterInterface as Console;
use Zend\ModuleManager\Feature\ConsoleBannerProviderInterface;

class Module
{
    public function getConsoleBanner(Console $console)
    {
        return
            "==----------------------------------==\n" .
            "    Helloworld module, Version 1.0    \n" .
            "==----------------------------------==\n";
    }

    public function getConsoleUsage(Console $console)
    {
        return array(
            'show date [--format=]'
                => 'Displays the current datetime.',

            array(
                '--format=FORMAT',
                'Supports formatting ' .
                    'of PHPs "date()" function.'
            ),
        );
    }

    /* Examples for using the init method
    public function init(ModuleManager $moduleManager)
    {
        // Register a listener
        $moduleManager->getEventManager()
            ->attach(
                ModuleEvent::EVENT_LOAD_MODULES_POST,
                array($this, 'onModulesPost')
            );


        // Change the layout template to be used based on the requested controller's module
        $sharedEvents = $moduleManager->getEventManager()
            ->getSharedManager();

        $sharedEvents->attach(
            __NAMESPACE__,
            'dispatch',
            function($e) {
                $controller = $e->getTarget();
                $controller->layout('layout/helloWorldLayout');
            },
            100
        );
    }

    public function onModulesPost()
    {
        die("Modules loaded!");
    }
    */

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__
                )
            )
        );
    }

    public function getConfig()
   	{
       	return include __DIR__ . '/config/module.config.php';
   	}

    public function getControllerPluginConfig()
    {
        return array(
            'invokables' => array(
                'currentDate'
                 => 'Helloworld\Controller\Plugin\CurrentDate'
            )
        );
    }

    public function getViewHelperConfig()
    {
        return array(
            'invokables' => array(
                'displayCurrentDate'
					=> 'Helloworld\View\Helper\DisplayCurrentDate'
            )
        );
    }

    /* Alternative way to provide the ServiceManager config (instead of using module.config.php)
    public function getServiceConfig()
    {
        return array(
            'invokables' => array(
                'greetingService'
                	=> 'Helloworld\Service\GreetingService'
            )
        );
    }
    */

    /* Alternative way to define view helpers (instead of using module.config.php
    public function getViewHelperConfig()
	{
		return array(
			'invokables' => array(
				'displayCurrentDate'
					=> 'Helloworld\View\Helper\DisplayCurrentDate'
			)
		);
	}
    */
}