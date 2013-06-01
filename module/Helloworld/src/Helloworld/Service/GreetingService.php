<?php
namespace Helloworld\Service;

use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\EventManagerAwareInterface;

class GreetingService implements EventManagerAwareInterface
{
	private $eventManager;

	public function getGreeting()
	{
        /* Must be set if shared event manager is used
        $this->eventManager->addIdentifiers('GreetingService');
        */

        /* Example for using a custom event class
        $this->eventManager->setEventClass('Helloworld\Event\MyEvent');
         */

        $this->eventManager->trigger('getGreeting');

		if(date("H") <= 11)
			return "Good morning, world!";
		else if (date("H") > 11 && date("H") < 17)
			return "Hello, world!";
		else
			return "Good evening, world!";
	}

	public function getEventManager()
	{
		return $this->eventManager;
	}

	public function setEventManager(EventManagerInterface $em)
	{
		$this->eventManager = $em;
	}
}