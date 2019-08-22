<?php

declare(strict_types=1);

namespace Cadastro\Handler\Cliente;

use Cadastro\Model\Entity\Cliente;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

class DeletarHandlerFactory
{
    public function __invoke(ContainerInterface $container): DeletarHandler
    {
        $entityManager = $container->get(EntityManager::class);
        $clienteRepository = $entityManager->getRepository(Cliente::class);
        return new DeletarHandler($clienteRepository);
    }
}
