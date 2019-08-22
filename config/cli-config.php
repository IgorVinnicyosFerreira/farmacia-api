<?php

use Doctrine\ORM\EntityManager;

$container = require 'config/container.php';

return new \Symfony\Component\Console\Helper\HelperSet([
    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper(
        $container->get(EntityManager::class)
    ),
]);
