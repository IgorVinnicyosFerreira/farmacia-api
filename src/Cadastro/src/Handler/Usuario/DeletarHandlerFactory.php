<?php

declare(strict_types=1);

namespace Cadastro\Handler\Usuario;

use Cadastro\Model\Entity\Usuario;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

class DeletarHandlerFactory
{
    public function __invoke(ContainerInterface $container): DeletarHandler
    {
        $entityManager = $container->get(EntityManager::class);

        $usuarioRepository = $entityManager->getRepository(Usuario::class);

        return new DeletarHandler($usuarioRepository);
    }
}
