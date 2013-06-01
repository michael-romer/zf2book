<?php

namespace Helloworld\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AuthController extends AbstractActionController
{
	private $loginForm;
	private $authService;

    public function loginAction()
    {
        if ($this->authService->hasIdentity())
        {
            return new ViewModel(
                array(
                    'loginSuccess' => true,
                    'userLoggedIn'
                        => $this->authService->getIdentity()
                )
            );
        }

        if (!$this->loginForm)
            throw new \BadMethodCallException('Login Form not yet set!');

        if (!$this->authService)
            throw new \BadMethodCallException('Auth Service not yet set!');

        if ($this->getRequest()->isPost()) {
            $this->loginForm->setData($this->getRequest()->getPost());

            if ($this->loginForm->isValid()) {

                $data = $this->loginForm->getData();

                $this->authService->getAdapter()
                    ->setIdentity($data['username']);

                $this->authService->getAdapter()
                    ->setCredential($data['password']);

                $authResult = $this->authService->authenticate();

                if (!$authResult->isValid())
                {
                    return new ViewModel(
                        array(
                            'form' => $this->loginForm,
                            'loginError' => true
                        )
                    );
                }
                else
                    return new ViewModel(
                        array(
                            'loginSuccess' => true,
                            'userLoggedIn'
                                => $authResult->getIdentity()
                    )
                );
            } else {
                return new ViewModel(
                    array(
                        'form' => $this->loginForm
                    )
                );
            }
        } else {
            return new ViewModel(
                array(
                    'form' => $this->loginForm
                )
            );
        }
    }

    public function logoutAction()
    {
        if ($this->authService->hasIdentity())
            $this->authService->clearIdentity();

        $this->redirect()->toUrl('/login');
    }

	public function setLoginForm($loginForm)
	{
		$this->loginForm = $loginForm;
	}

	public function getLoginForm()
	{
		return $this->loginForm;
	}

	public function setAuthService($authService)
	{
		$this->authService = $authService;
	}

	public function getAuthService()
	{
		return $this->authService;
	}
}