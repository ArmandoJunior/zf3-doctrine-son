<?php
/**
 * Created by PhpStorm.
 * User: arman
 * Date: 01/01/2019
 * Time: 09:32
 */

namespace User\Service\Factory;


use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\Authentication\Adapter\DbTable\CallbackCheckAdapter;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Storage\Session;
use Zend\Db\Adapter\AdapterInterface;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

class AuthenticationServiceFactory implements FactoryInterface
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
        $passwordCallbackVerify = function ($passwordInDatabase, $passwordSent) {
            return password_verify($passwordSent, $passwordInDatabase);
        };
        $dbAdapter = $container->get(AdapterInterface::class);
        $authAdapter = new CallbackCheckAdapter($dbAdapter, 'users', 'username', 'password', $passwordCallbackVerify);
        $storage = new Session();
        return new AuthenticationService($storage, $authAdapter);
    }
}