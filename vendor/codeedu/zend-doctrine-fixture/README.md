## About

This library provides integration with Zend Framework and Doctrine Data Fixture. Also support PSR-11.
It's based in [zendexpr-doctrine-fixture](https://github.com/codeedu/zendexpr-doctrine-fixture.git)

## Get started

##### Instalation
```sh
composer require codeedu/zend-doctrine-fixture:0.0.1
```

##### Registering Fixtures

To register fixtures add the fixtures in your configuration.

```php
[
      'doctrine' => [
            'fixture' => [
                  'MyFixtures' => __DIR__ . '/../src/Fixture',
            ]
      ]
];
```

Register the module in modules.config.php:

```php
      'CodeEdu\DoctrineFixture'
```

## Usage

#### Command Line
Access the Doctrine command line as following

#### Import
```sh
./vendor/bin/doctrine-module data-fixture:import
```

## Dependency Injection with Fixtures

This library provides inject the service container in fixtures. So add interface **FixtureContainerInterface**, see below:

```php
class MyFixture implements FixtureInterface, FixtureContainerInterface
{
    private $container;

    public function load(ObjectManager $manager){
        $myService = $this->container->get(MyService::class);
    }

    public function getContainer()
    {
        return $this->container;
    }

    public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;
    }
}
```
