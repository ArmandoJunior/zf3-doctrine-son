<?php
/**
 * Created by PhpStorm.
 * User: arman
 * Date: 31/12/2018
 * Time: 16:58
 */

namespace Blog\Form\Factory;


use Blog\Form\PostForm;
use Blog\Inputfilter\PostInputfilter;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

class PostFormFactory implements FactoryInterface
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
        $inputFilter = new PostInputfilter();
        $form = new PostForm('post');
        $form->setInputFilter($inputFilter);
        return $form;
    }
}