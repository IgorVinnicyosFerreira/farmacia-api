<?php

use Doctrine\Migrations\Configuration\Configuration;
use Doctrine\Migrations\Tools\Console\Helper\ConfigurationHelper;
use Doctrine\ORM\EntityManager;

$container = require 'container.php';

/* @var $em \Doctrine\ORM\EntityManager */
$em = $container->get(EntityManager::class);
$configuration = new Configuration($em->getConnection());
$config = $container->get('config')['doctrine']['migrations_configuration']['orm_default'];

$configuration->setName($config['name']);
$configuration->setMigrationsDirectory($config['directory']);
$configuration->setMigrationsNamespace($config['namespace']);
$configuration->setMigrationsTableName($config['table']);

return new \Symfony\Component\Console\Helper\HelperSet([
    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($em),
    'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($em->getConnection()),
    'configuration' =>  new ConfigurationHelper($em->getConnection(), $configuration)
]);
