<?php

declare(strict_types=1);

namespace Cadastro\Cliente;

use Psr\Container\ContainerInterface;

class InserirHandlerFactory
{
    public function __invoke(ContainerInterface $container) : InserirHandler
    {
        return new InserirHandler();
    }
}
