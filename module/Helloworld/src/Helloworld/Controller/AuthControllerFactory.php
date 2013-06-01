<?php
namespace Helloworld\Controller;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AuthControllerFactory implements FactoryInterface
{
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$ctr = new AuthController();
		$ctr->setLoginForm(new \Helloworld\Form\Login());

		$ctr->setAuthService($serviceLocator
			->getServiceLocator()
			->get('Helloworld\Service\AuthService'));

		return $ctr;
	}
}