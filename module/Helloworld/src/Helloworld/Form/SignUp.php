<?php
namespace Helloworld\Form;

use Zend\Form\Form;

class SignUp extends Form
{
	public function __construct()
	{
		parent::__construct('signUp');
		$this->setAttribute('action', '/signup');
		$this->setAttribute('method', 'post');

		$this->add(array(
			'type' => 'Helloworld\Form\UserFieldset',
			'options' => array(
				'use_as_base_fieldset' => true
			)
		));

		$this->add(array(
			'name' => 'submit',
			'attributes' => array(
				'type'  => 'submit',
				'value' => 'Eintragen'
			),
		));
	}
}