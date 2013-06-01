<?php

namespace Helloworld\Mapper;

use Helloworld\Entity\Host as HostEntity;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\TableGateway\Feature\RowGatewayFeature;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Insert;

class Host extends TableGateway
{
	protected $tableName  = 'host';
	protected $idCol = 'id';
	protected $entityPrototype = null;
	protected $hydrator = null;

	public function __construct($adapter)
	{
		parent::__construct($this->tableName,
			$adapter,
			new RowGatewayFeature($this->idCol)
		);

		$this->entityPrototype = new HostEntity();
		$this->hydrator = new HostHydrator();
	}

	public function findByIp($ip)
	{
		return $this->hydrate(
			$this->select(array('ip' => $ip))
		);
	}

	public function hydrate($results)
	{
		$hosts = new \Zend\Db\ResultSet\HydratingResultSet(
			$this->hydrator,
			$this->entityPrototype
		);

		return $hosts->initialize($results->toArray());
	}

	public function insert($entity)
	{
		return parent::insert($this->hydrator->extract($entity));
	}

	public function updateEntity($entity)
	{
		return parent::update(
			$this->hydrator->extract($entity),
			$this->idCol . "=" . $entity->getId()
		);
	}
}