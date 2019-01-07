<?php
/**
 * Created by PhpStorm.
 * User: arman
 * Date: 31/12/2018
 * Time: 18:23
 */

namespace User\Controller;


use User\Form\LoginForm;
use Zend\Authentication\AuthenticationServiceInterface;
use Zend\Authentication\Adapter\DbTable\CallbackCheckAdapter;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AuthController extends AbstractActionController
{
    /**
     * @var AuthenticationServiceInterface
     */
    private $authenticationService;
    /**
     * @var LoginForm
     */
    private $form;

    /**
     * AuthController constructor.
     * @param AuthenticationServiceInterface $authenticationService
     * @param LoginForm $form
     */
    public function __construct(AuthenticationServiceInterface $authenticationService, LoginForm $form)
    {
        $this->authenticationService = $authenticationService;
        $this->form = $form;
    }

    /**
     * @return \Zend\Http\Response|ViewModel
     */
    public function loginAction()
    {
        if ($this->authenticationService->hasIdentity()) {
            return $this->redirect()->toRoute('admin-blog/post');
        }

        $form = $this->form;
        $messageError = null;

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost();
            $form->setData($data);
            if ($form->isValid()) {
                $formData = $form->getData();
                /** @var CallbackCheckAdapter $authAdapter */
                $authAdapter = $this->authenticationService->getAdapter();
                $authAdapter->setIdentity($formData['username']);
                $authAdapter->setCredential($formData['password']);

                $result = $this->authenticationService->authenticate();
                if ($result->isValid()) {
//                    var_dump($this->authenticationService->getIdentity());
                    return $this->redirect()->toRoute('admin-blog/post');
                } else {
                    $messageError = "Login Inválido";
                }
            }
        }

        return new ViewModel([
            'form' => $form,
            'messageError' => $messageError
        ]);
    }

    public function logoutAction()
    {
        $this->authenticationService->clearIdentity();

        return $this->redirect()->toRoute('login');
    }
}