<?php
namespace Helloworld\Mapper;

use Zend\Stdlib\Hydrator\Reflection;
use Helloworld\Entity\Host;

class HostHydrator extends Reflection
{
	public function hydrate(array $data, $object)
	{
		if (!$object instanceof Host) {
			throw new \InvalidArgumentException(
				'$object must be an instance of Helloworld\Entity\Host'
			);
		}

        /* Custom mapping demo
		$data = $this->mapField('workstation', 'hostname', $data);
        */

		return parent::hydrate($data, $object);
	}

	protected function mapField($keyFrom, $keyTo, array $array)
	{
		$array[$keyTo] = $array[$keyFrom];
		unset($array[$keyFrom]);
		return $array;
	}
}