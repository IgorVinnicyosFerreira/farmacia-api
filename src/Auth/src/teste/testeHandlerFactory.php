<?php

declare(strict_types=1);

namespace Auth\teste;

use Psr\Container\ContainerInterface;

class testeHandlerFactory
{
    public function __invoke(ContainerInterface $container) : testeHandler
    {
        return new testeHandler();
    }
}
