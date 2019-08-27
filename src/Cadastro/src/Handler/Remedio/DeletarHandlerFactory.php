<?php

declare(strict_types=1);

namespace Cadastro\Handler\Remedio;

use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;
use Cadastro\Model\Entity\Remedio;

class DeletarHandlerFactory
{
    public function __invoke(ContainerInterface $container): DeletarHandler
    {
        $entityManager = $container->get(EntityManager::class);
        $remedioRepository = $entityManager->getRepository(Remedio::class);
        return new DeletarHandler($remedioRepository);
    }
}
