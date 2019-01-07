<?php
/**
 * Created by PhpStorm.
 * User: arman
 * Date: 01/01/2019
 * Time: 12:27
 */

namespace Blog\Controller\Factory;


use Blog\Controller\PostController;
use Blog\Form\CommentForm;
use Blog\Model\Comment;
use Blog\Model\CommentTable;
use Blog\Model\PostTable;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

class PostControllerfactory implements FactoryInterface
{

    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string $requestedName
     * @param  null|array $options
     * @return PostController|object
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an exception is raised when
     *     creating a service.
     * @throws ContainerException if any other error occurs
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        echo $requestedName . ' - ';
        $postTable = $container->get(PostTable::class);
//        $comment = $container->get(new Comment());
        $commentTable = $container->get(CommentTable::class);
        $commentForm = $container->get(CommentForm::class);

        return new PostController($postTable, $commentForm, $commentTable);
    }
}