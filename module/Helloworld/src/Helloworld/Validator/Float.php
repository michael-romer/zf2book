<?php
namespace Helloworld\Validator;

use Zend\Validator\AbstractValidator;

class Float extends AbstractValidator
{
	const FLOAT = 'float';

	protected $messageTemplates = array(
		self::FLOAT => "'%value%' is not a float value."
	);

	public function isValid($value)
	{
		$this->setValue($value);

		if (!is_float($value)) {
			$this->error(self::FLOAT);
			return false;
		}

		return true;
	}
}