<?php
/**
 * Created by PhpStorm.
 * User: arman
 * Date: 30/12/2018
 * Time: 16:43
 */

namespace Blog;

use Blog\Controller\BlogController;
use Blog\Controller\Factory\BlogControllerFactory;
use Blog\Controller\Factory\PostControllerfactory;
use Blog\Controller\PostController;
use Blog\Form\CommentForm;
use Blog\Form\Factory\CommentFormFactory;
use Blog\Form\Factory\PostFormFactory;
use Blog\Form\PostForm;
use Blog\Model\Factory\CommentTableFactory;
use Blog\Model\Factory\CommentTableGatewayFactory;
use Blog\Model\Factory\PostTableFactory;
use Blog\Model\Factory\PostTableGatewayFactory;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ControllerProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;

class Module implements ConfigProviderInterface, ServiceProviderInterface, ControllerProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . "/../config/module.config.php";
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                Model\PostTable::class => PostTableFactory::class,
                Model\CommentTable::class => CommentTableFactory::class,
                Model\PostTableGateway::class => PostTableGatewayFactory::class,
                Model\CommentTableGateway::class => CommentTableGatewayFactory::class,
                PostForm::class => PostFormFactory::class,
                CommentForm::class => CommentFormFactory::class
            ]
        ];
    }

    public function getControllerConfig()
    {
        return [
            'factories' => [
                BlogController::class => BlogControllerFactory::class,
                PostController::class => PostControllerfactory::class
            ]
        ];
    }


}