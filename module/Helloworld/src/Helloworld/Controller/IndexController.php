<?php
namespace Helloworld\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

class IndexController extends AbstractActionController
{
    private $greetingSrv;

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
        if ($this->serviceLocator)
            $this->greetingSrv = $this->getServiceLocator()->get('greetingService');

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

        /* Examples for sending an email
        $mail = new \Zend\Mail\Message();
        $mail->setBody('Hi, Michael!');
        $mail->setFrom('sender@example.com', 'Sender name');
        $mail->addTo('zf2buch@michael-romer.de', 'Michael Romer');
        $mail->setSubject('Mail subject');
        $transport = new \Zend\Mail\Transport\Sendmail();
        $transport->send($mail);

        // Multipart email
        $textPart = new \Zend\Mime\Part('Hi, Michael!');
        $textPart->type = "text/plain";

        $htmlPart = new \Zend\Mime\Part("<h1>Hi, Michael!</h1>");
        $htmlPart->type = "text/html";

        $body = new \Zend\Mime\Message();
        $body->setParts(array($textPart, $htmlPart));

        $mail = new \Zend\Mail\Message();
        $mail->setBody($body);
        $mail->setFrom('sender@example.com', 'Sender name');
        $mail->addTo('zf2buch@michael-romer.de', 'Michael Romer');
        $mail->setSubject('Mail subject');

        $mail->getHeaders()->get('content-type')
            ->setType('multipart/alternative');

        $transport = new \Zend\Mail\Transport\Sendmail();
        $transport->send($mail);

        // With HTML template & attachment

        $view = $this->getServiceLocator()->get('ViewManager')->getView();

        $viewModel = new \Zend\View\Model\ViewModel(
            array('name' => 'Michael')
        );

        $viewModel->setOption('has_parent', true);
        $viewModel->setTemplate('zf-deals/mails/say-hi-to-user');

        $textPart = new \Zend\Mime\Part('Hi, Michael!');
        $textPart->type = "text/plain";

        $file = __DIR__ . '/attachment.txt';
        $attachment = new \Zend\Mime\Part(file_get_contents($file));
        $attachment->filename = basename($file);
        $attachment->disposition = \Zend\Mime\Mime::DISPOSITION_ATTACHMENT;
        $attachment->encoding = \Zend\Mime\Mime::ENCODING_8BIT;

        $body = new \Zend\Mime\Message();
        $body->setParts(array($textPart, $attachment));

        $mail = new \Zend\Mail\Message();
        $mail->setBody($body);
        $mail->setFrom('sender@example.com', 'Sender name');
        $mail->addTo('zf2buch@michael-romer.de', 'Michael Romer');
        $mail->setSubject('Mail subject');

        $transport = new \Zend\Mail\Transport\Sendmail();
        $transport->send($mail);
        */

        /* Navigation example
        $container = new \Zend\Navigation\Navigation(array(
            array(
                'label' => 'Home',
                'id' => 'home',
                'route' => 'home'
            ),
            array(
                'label' => 'Links',
                'id' => 'links',
                'uri' => '#',
                'pages' => array(
                    array(
                        'label' => 'ZF2 Download',
                        'id' => 'zf2',
                        'uri' => 'http://framework.zend.com'
                    ),
                    array(
                        'label' => 'ZF2 Book',
                        'id' => 'zf2book',
                        'uri' => 'http://zf2book.com/'
                    )
                )
            )
        ));
         */

        $date = date("now");

        try {
            $date = $this->currentDate();
        } catch(\Exception $e) {
            // just making sure it does not crash if currentDate is not available
        }

        return new ViewModel(
            array(
                'greeting' => $this->greetingSrv->getGreeting(),
                'date' => $date,
                'form' => $form
            )
        );

   	}

    public function usersAction()
   	{
        if ($this->authService->hasIdentity())
            $this->redirect()->toUrl('/login');

   		$acl = new \Zend\Permissions\Acl\Acl;
   		$guestRole = new \Zend\Permissions\Acl\Role\GenericRole('guest');
   		$adminRole = new \Zend\Permissions\Acl\Role\GenericRole('admin');
   		$acl->addRole($guestRole);
   		$acl->addRole($adminRole, $guestRole);

   		$usersPage =
   			new \Zend\Permissions\Acl\Resource\GenericResource('usersPage');

   		$acl->addResource($usersPage);
   		$acl->allow($adminRole, $usersPage, 'view');

   		if(!$acl->isAllowed('admin', 'usersPage', 'view'))
   			throw new \DomainException('Resource not available');

   		/* $users = [..] load users from database
   		return new ViewModel(
   			array(
   				'users' => $users
   			)
   		);
   		*/
   	}

    public function dateAction()
    {
        return date('D M d H:i:s e Y') . PHP_EOL;
    }

    public function helloAction()
    {
        $result = new JsonModel(
            array(
                'greeting' => 'hello world',
            )
        );

    }

    public function setGreetingService($service)
    {
        $this->greetingSrv = $service;
    }
}