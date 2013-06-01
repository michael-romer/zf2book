<?php
namespace Helloworld\Service;

use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\EventManagerAwareInterface;
use Helloworld\Service\GreetingService\HourProviderInterface;

class GreetingService implements EventManagerAwareInterface
{
	private $eventManager;
    private $hourProvider;

	public function getGreeting()
	{
        if (!$this->hourProvider)
            throw new \BadMethodCallException('HourProvider not yet set.');

        /* Must be set if shared event manager is used
        $this->eventManager->addIdentifiers('GreetingService');
        */

        /* Example for using a custom event class
        $this->eventManager->setEventClass('Helloworld\Event\MyEvent');
         */

        /* Setting up a fresh event manager just in case no event manager has been injected */
        if (!$this->eventManager)
            $this->eventManager = new \Zend\EventManager\EventManager();

        $this->eventManager->trigger('getGreeting');

        $hour = $this->hourProvider->getHour();

        if($hour <= 11)
            return "Good morning, world!";
        else if ($hour > 11 && $hour < 17)
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

    public function setHourProvider(HourProviderInterface $hourProvider)
    {
        $this->hourProvider = $hourProvider;
    }

    public function getHourProvider()
    {
        return $this->hourProvider;
    }
}