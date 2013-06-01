<?php
namespace HelloworldTest\ServiceTest\GreetingServiceTest;

use Helloworld\Service\GreetingService\HourProviderInterface;

class HourProviderFake implements HourProviderInterface
{
	private $hourToReturn = 0;

	public function getHour()
	{
		return $this->hourToReturn;
	}

	public function setHourToReturn($hourToReturn)
	{
		$this->hourToReturn = $hourToReturn;
	}

	public function getHourToReturn()
	{
		return $this->hourToReturn;
	}
}