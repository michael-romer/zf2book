<?php
namespace Helloworld\Event;

use Zend\EventManager\Event;

class MyEvent extends Event
{
	private $myObject;

	public function setMyObject($myObject)
	{
		$this->myObject = $myObject;
	}

	public function getMyObject()
	{
		return $this->myObject;
	}
}