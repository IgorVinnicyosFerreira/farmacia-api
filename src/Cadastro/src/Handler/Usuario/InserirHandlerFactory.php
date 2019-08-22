<?php

declare(strict_types=1);

namespace Cadastro\Handler\Usuario;

use Auth\Model\Entity\Acesso;
use Cadastro\Model\Entity\Usuario;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

class InserirHandlerFactory
{
    public function __invoke(ContainerInterface $container): InserirHandler
    {
        $entityManager = $container->get(EntityManager::class);

        $usuarioRepository = $entityManager->getRepository(Usuario::class);

        return new InserirHandler($usuarioRepository);
    }
}
