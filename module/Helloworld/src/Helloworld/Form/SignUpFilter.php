<?php
namespace Helloworld\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;

class SignUpFilter extends InputFilter
{
	public function __construct()
	{
		$this->add(array(
			'name' => 'email',
			'validators' => array(
				array(
					'name' => 'NotEmpty',
					'break_chain_on_failure' => true,
					'options' => array(
						'messages' => array(
				\Zend\Validator\NotEmpty::IS_EMPTY =>
				'Please enter your information.'
						)
					)
				),
				array(
					'name' => 'EmailAddress',
					'options' => array(
						'messages' => array(
				\Zend\Validator\EmailAddress::INVALID_FORMAT =>
				'Please enter a valid email.'
						)
					)
				),
			),
		));

		$this->add(array(
			'name' => 'name',
			'filters' => array(
				array(
					'name' => 'StringTrim'
				)
			),
			'validators' => array(
				array(
					'name' => 'NotEmpty',
					'options' => array(
						'messages' => array(
				\Zend\Validator\NotEmpty::IS_EMPTY =>
				'Please enter your information.'
						)
					)
				)
			)
		));
	}
}