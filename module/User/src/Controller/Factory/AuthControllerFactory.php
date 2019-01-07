<?php
/**
 * Created by PhpStorm.
 * User: arman
 * Date: 31/12/2018
 * Time: 20:47
 */

namespace User\Controller\Factory;


use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use User\Controller\AuthController;
use User\Form\LoginForm;
use Zend\Authentication\AuthenticationServiceInterface;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

class AuthControllerFactory implements FactoryInterface
{

    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string $requestedName
     * @param  null|array $options
     * @return object
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an exception is raised when
     *     creating a service.
     * @throws ContainerException if any other error occurs
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        echo $requestedName . ' - ';
        $authService = $container->get(AuthenticationServiceInterface::class);
        $formLogin = $container->get(LoginForm::class);

        return new AuthController($authService, $formLogin);
    }
}