<?php


namespace CodeEdu\DoctrineFixture;

use CodeEdu\FixtureFactory;
use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature\DependencyIndicatorInterface;
use Zend\ModuleManager\Feature\InitProviderInterface;
use Zend\ModuleManager\ModuleManagerInterface;

class Module implements DependencyIndicatorInterface, InitProviderInterface
{


    /**
     * Expected to return an array of modules on which the current one depends on
     *
     * @return array
     */
    public function getModuleDependencies()
    {
        return array('DoctrineORMModule');
    }

    /**
     * {@inheritDoc}
     */
    public function init(ModuleManagerInterface $manager)
    {
        $events = $manager->getEventManager();
        $events->getSharedManager()->attach('doctrine', 'loadCli.post', array($this, 'initializeConsole'));
    }


    /**
     * Initializes the console with additional commands from the ORM, DBAL and (optionally) DBAL\Migrations
     *
     * @param \Zend\EventManager\EventInterface $event
     *
     * @return void
     */
    public function initializeConsole(EventInterface $event)
    {
        /* @var $cli \Symfony\Component\Console\Application */
        $cli            = $event->getTarget();
        /* @var $serviceLocator \Zend\ServiceManager\ServiceLocatorInterface */
        $serviceLocator = $event->getParam('ServiceManager');
        $command = new FixtureFactory();
        $cli->addCommands([$command($serviceLocator)]);
    }
}