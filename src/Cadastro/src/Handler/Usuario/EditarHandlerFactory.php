<?php

declare(strict_types=1);

namespace Cadastro\Handler\Usuario;

use Cadastro\Model\Entity\Usuario;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

class EditarHandlerFactory
{
    public function __invoke(ContainerInterface $container): EditarHandler
    {
        $entityManager = $container->get(EntityManager::class);

        $usuarioRepository = $entityManager->getRepository(Usuario::class);
        return new EditarHandler($usuarioRepository);
    }
}
