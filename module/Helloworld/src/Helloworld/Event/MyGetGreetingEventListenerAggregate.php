<?php
namespace Helloworld\Event;

use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\EventManagerInterface;

class MyGetGreetingEventListenerAggregate
	implements ListenerAggregateInterface
{
	public function attach(EventManagerInterface $eventManager)
	{
		$eventManager->attach(
			'getGreeting',
			function($e){
				// [..]
			}
		);

		$eventManager->attach(
			'refreshGreeting',
			function($e){
				//[..]
			}
		);
	}

	public function detach(EventManagerInterface $events)
	{
		// [..]
	}
}