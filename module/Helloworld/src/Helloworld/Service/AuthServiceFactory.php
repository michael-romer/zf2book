<?php
namespace Helloworld\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Authentication\Storage\Session;
use Zend\Authentication\Adapter\DbTable;

class AuthServiceFactory implements FactoryInterface
{
	const TABLE_NAME = "users";
	const IDENTITY_COLUMN = "username";
	const CREDENTIAL_COLUMN = "password";

	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$dbAdapter = $serviceLocator->get('Zend\Db\Adapter\Adapter');

		$service = new \Zend\Authentication\AuthenticationService(
			new Session(),
			new DbTable(
				$dbAdapter,
				self::TABLE_NAME,
				self::IDENTITY_COLUMN,
				self::CREDENTIAL_COLUMN,
                'md5(?)'
			)
		);

		return $service;
	}
}