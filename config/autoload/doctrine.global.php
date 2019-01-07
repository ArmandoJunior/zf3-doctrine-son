<?php
return [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'driverClass' => \Doctrine\DBAL\Driver\PDOMySql\Driver::class,
                'params' => [
                    'host'     => 'localhost',
                    'port'     => '3306',
                    'user'     => 'root',
                    'password' => 'root',
                    'dbname'   => 'condominio',
                    'driverOptions' => [
                        \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"
                    ]
                ],
            ],
        ],
    ],
];