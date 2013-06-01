<?php
namespace Helloworld\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;

class LoginFilter extends InputFilter
{
	public function __construct()
	{
		$this->add(array(
			'name' => 'username',
			'required'=> true,
		));

		$this->add(array(
			'name' => 'password',
			'required' => true,
		));
	}
}