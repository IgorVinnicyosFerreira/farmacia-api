<?php

declare(strict_types=1);

namespace App\Handler\Compra;

use Cadastro\Model\Entity\Cliente;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

class ComprasPorClienteHandlerFactory
{
    public function __invoke(ContainerInterface $container): ComprasPorClienteHandler
    {
        $entityManager = $container->get(EntityManager::class);
        $clienteRepository = $entityManager->getRepository(Cliente::class);

        return new ComprasPorClienteHandler($clienteRepository);
    }
}
