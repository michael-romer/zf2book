<?php
namespace Helloworld\Form;

use Zend\Form\Fieldset;

class UserAddressFieldset extends Fieldset
{
	public function __construct()
	{
		parent::__construct('userAddress');
		$this->setHydrator(new \Zend\Stdlib\Hydrator\Reflection());
		$this->setObject(new \Helloworld\Entity\UserAddress());

		$this->add(array(
			'name' => 'street',
			'attributes' => array(
				'type'  => 'text',
			),
			'options' => array(
				'label' => 'Your street:',
			)
		));

		$this->add(array(
			'name' => 'streetNumber',
			'attributes' => array(
				'type'  => 'text',
			),
			'options' => array(
				'label' => 'Your street number:',
			)
		));

		$this->add(array(
			'name' => 'zipcode',
			'attributes' => array(
				'type'  => 'text',
			),
			'options' => array(
				'label' => 'Your zipcode:',
			)
		));

		$this->add(array(
			'name' => 'city',
			'attributes' => array(
				'type'  => 'text',
			),
			'options' => array(
				'label' => 'Your city:',
			)
		));
	}
}