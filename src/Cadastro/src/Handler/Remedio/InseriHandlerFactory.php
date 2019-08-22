<?php

declare(strict_types=1);

namespace Cadastro\Handler\Remedio;

use Cadastro\Entity\Remedio;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

class InseriHandlerFactory
{
    public function __invoke(ContainerInterface $container): InseriHandler
    {

        $entityManager = $container->get(EntityManager::class);
        $remedioRepository = $entityManager->getRepository(Remedio::class);

        return new InseriHandler($remedioRepository);
    }
}
