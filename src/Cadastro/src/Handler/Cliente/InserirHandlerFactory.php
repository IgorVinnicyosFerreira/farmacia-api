<?php

declare(strict_types=1);

namespace Cadastro\Handler\Cliente;

use Cadastro\Model\Entity\Cliente;
use Cadastro\Repository\ClienteRepository;
use Psr\Container\ContainerInterface;
use Doctrine\ORM\EntityManager;

class InserirHandlerFactory
{
    public function __invoke(ContainerInterface $container): InserirHandler
    {

        $entityManager = $container->get(EntityManager::class);
        $clienteRepository = $entityManager->getRepository(Cliente::class);
        return new InserirHandler($clienteRepository);
    }
}
