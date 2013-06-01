<?php
namespace Helloworld\Service\GreetingService;

use Helloworld\Service\GreetingService\HourProviderInterface;

class HourProviderDateFunction implements HourProviderInterface
{
	public function getHour()
	{
		return date("H");
	}
}