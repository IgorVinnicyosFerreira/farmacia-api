<?php

declare(strict_types=1);

namespace Cadastro\Model\Validator;

use Psr\Container\ContainerInterface;

class ClienteValidatorFactory
{
    public function __invoke(ContainerInterface $container) : ClienteValidator
    {
        return new ClienteValidator();
    }
}
