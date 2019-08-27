<?php

declare(strict_types=1);

namespace App\Handler\Compra;

use App\Model\Entity\Compra;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

class ListarHandlerFactory
{
    public function __invoke(ContainerInterface $container): ListarHandler
    {
        $entityManger = $container->get(EntityManager::class);
        $compraRepository = $entityManger->getRepository(Compra::class);

        return new ListarHandler($compraRepository);
    }
}
