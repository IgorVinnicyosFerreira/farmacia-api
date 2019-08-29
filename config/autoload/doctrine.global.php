<?php

declare(strict_types=1);

use Doctrine\DBAL\Driver\PDOMySql\Driver;

return [
    'doctrine' => [
        'connection' => [
            // default connection name
            'orm_default' => [
                'driverClass' => Driver::class,
                'params' => [
                    'host'            => 'db4free.net',
                    'port'            => '3306',
                    'user'            => 'development',
                    'password'        => 'farmacia4590',
                    'dbname'          => 'farmacia_api',
                    'driverOptions'   => [
                        \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
                    ]
                ],
            ],
        ],
        'migrations_configuration' => [
            'orm_default' => [
                'directory' => 'data/Migrations',
                'name'      => 'Doctrine Database Migrations',
                'namespace' => 'Migrations',
                'table'     => 'migrations',
                'column'
            ],
        ],
    ],
];
