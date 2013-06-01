<?php
namespace HelloworldTest\ServiceTest;

class GreetingServiceTest extends \PHPUnit_Framework_TestCase
{
	public function testGetGreeting()
	{
		$greetingService = new \Helloworld\Service\GreetingService();
		$hourProviderFake = new GreetingServiceTest\HourProviderFake();
		$greetingService->setHourProvider($hourProviderFake);

		for($i = 0; $i <= 24; $i++)
		{
			$hourProviderFake->setHourToReturn($i);
			$greeting = $greetingService->getGreeting();

			if($i <= 11)
				$this->assertEquals("Good morning, world!", $greeting);
			else if ($i > 11 && $i < 17)
				$this->assertEquals("Hello, world!", $greeting);
			else
				$this->assertEquals("Good evening, world!", $greeting);
		}
	}
}