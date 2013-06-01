<?php
namespace HelloworldTest\ControllerTest;

use HelloworldTest\ServiceTest\GreetingServiceTest\GreetingServiceFake;
use Helloworld\Controller\IndexController;
use Zend\Http\Request;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\RouteMatch;

class IndexControllerTest extends \PHPUnit_Framework_TestCase
{
	private $controller;
	private $request;
	private $routeMatch;
	private $event;

	public function setUp()
	{
		$this->controller = new IndexController();
		$this->request = new Request();
		$this->routeMatch = new RouteMatch(array('controller' => 'index'));
		$this->event = new MvcEvent();
		$this->event->setRouteMatch($this->routeMatch);
		$this->controller->setEvent($this->event);
}

	public function testIndexAction()
	{
		$greetingServiceFake = new GreetingServiceFake();
		$this->controller->setGreetingService($greetingServiceFake);
		$this->routeMatch->setParam('action', 'index');
		$response = $this->controller->dispatch($this->request);
		$viewModelValues = $response->getVariables();

		$this->assertEquals(
			$viewModelValues['greeting'],
			'Fake Greeting Line'
		);
	}
}