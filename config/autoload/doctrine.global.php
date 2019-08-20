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
                    'host'            => 'localhost',
                    'port'            => '3306',
                    'user'            => 'root',
                    'password'        => '',
                    'dbname'          => 'farmacia',
                    'driverOptions'   => [
                        \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
                    ]
                ],
            ],
        ],
    ],
];
