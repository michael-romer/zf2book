<?php
namespace Helloworld\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    private $greetingService;

   	public function indexAction()
   	{
        /* Example for returning a 503 status code, e.g. if site is in maintenance mode
        $resp = new \Zend\Http\PhpEnvironment\Response;
        $resp->setStatusCode(503);
        return $resp;
        */

        /* Using the hard-coded version for the greeting line
		return new ViewModel(array('greeting' => 'hello, world!'));
        */

        /* Using the custom ServiceManager service to create the greeting line */
        $greetingSrv = $this->getServiceLocator()
            ->get('greetingService');

        /* Demo usage of Host Mapper
        $hosts = $this->getServiceLocator()
    		->get('Helloworld\Mapper\Host')->findByIp('127.0.0.1');
        */

        /* Demo usage of SignUp form; should be injected in productive systems */
        $form = new \Helloworld\Form\SignUp();

        /* Demo for SignUp form processing
        $form->setHydrator(new \Zend\Stdlib\Hydrator\Reflection());
		$form->bind(new \Helloworld\Entity\User());

        if ($this->getRequest()->isPost()) {
       		$data = $this->getRequest()->getPost();
       	} else {
       		return new ViewModel(
       			array(
       				'form' => new \Helloworld\Form\SignUp()
       			)
       		);
       	}
        */

        return new ViewModel(
            array(
                'greeting' => $greetingSrv->getGreeting(),
                'date' => $this->currentDate(),
                'form' => $form
            )
        );

   	}

    public function setGreetingService($service)
    {
        $this->greetingService = $service;
    }
}