<?php

declare(strict_types=1);

namespace Cadastro\Model\Validator;

use Psr\Container\ContainerInterface;

class UsuarioValidatorFactory
{
    public function __invoke(ContainerInterface $container) : UsuarioValidator
    {
        return new UsuarioValidator();
    }
}
