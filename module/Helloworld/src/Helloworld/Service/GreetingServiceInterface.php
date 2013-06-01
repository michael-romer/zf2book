<?php
namespace Helloworld\Service;

use Helloworld\Service\GreetingService\HourProviderInterface;

interface GreetingServiceInterface
{
	public function getGreeting();
	public function setHourProvider(HourProviderInterface $hourProvider);
	public function getHourProvider();
}