<?php

declare(strict_types=1);

namespace App\Handler\Compra;

use App\Model\Entity\Compra;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

class InserirHandlerFactory
{
    public function __invoke(ContainerInterface $container): InserirHandler
    {
        $entityManager = $container->get(EntityManager::class);
        $compraRepository = $entityManager->getRepository(Compra::class);

        return new InserirHandler($compraRepository);
    }
}
