<?php
namespace HelloworldTest\ServiceTest\GreetingServiceTest;

use Helloworld\Service\GreetingService\HourProviderInterface;
use Helloworld\Service\GreetingServiceInterface;

class GreetingServiceFake implements GreetingServiceInterface
{
	public function getGreeting()
	{
		return "Fake Greeting Line";
	}

	public function setHourProvider(HourProviderInterface $hourProvider)
	{
		return;
	}

	public function getHourProvider()
	{
		return;
	}
}