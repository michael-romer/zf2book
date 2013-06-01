<?php

namespace Helloworld\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class CurrentDate extends AbstractPlugin
{
	public function __invoke()
	{
		return date('d.m.Y');
	}
}