<?php
/**
 * Created by PhpStorm.
 * User: arman
 * Date: 31/12/2018
 * Time: 15:11
 */

namespace Blog\Model\Factory;


use Blog\Model\Comment;
use Interop\Container\ContainerInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ServiceManager\Factory\FactoryInterface;

class CommentTableGatewayFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return object|TableGateway
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        echo $requestedName . ' - ';
        $dbAdapter = $container->get(AdapterInterface::class);
        $resultSetPrototype = new ResultSet();
        $resultSetPrototype->setArrayObjectPrototype(new Comment());
        return new TableGateway('Comments', $dbAdapter, null, $resultSetPrototype);
    }

}