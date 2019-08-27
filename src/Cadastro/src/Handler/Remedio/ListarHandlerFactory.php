<?php

declare(strict_types=1);

namespace Cadastro\Handler\Remedio;

use Cadastro\Model\Entity\Remedio;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

class ListarHandlerFactory
{
    public function __invoke(ContainerInterface $container): ListarHandler
    {
        $entityManager = $container->get(EntityManager::class);
        $remedioRepository = $entityManager->getRepository(Remedio::class);
        return new ListarHandler($remedioRepository);
    }
}
