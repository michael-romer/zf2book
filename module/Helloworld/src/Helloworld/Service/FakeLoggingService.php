<?php
namespace Helloworld\Service;

class FakeLoggingService implements LoggingServiceInterface
{
	public function log($str)
	{
		return;
	}
}