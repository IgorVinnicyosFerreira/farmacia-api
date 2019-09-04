<?php

declare(strict_types=1);

namespace Auth\Handler\Acesso;

use ExpressiveJWTAuth\JWT\JWT;
use Auth\Model\Entity\Acesso;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

class LoginHandlerFactory
{
    public function __invoke(ContainerInterface $container): LoginHandler
    {
        $jwtUtil = $container->get(JWT::class);
        $entityManager = $container->get(EntityManager::class);
        $acessoRepository = $entityManager->getRepository(Acesso::class);

        return new LoginHandler($jwtUtil, $acessoRepository);
    }
}
