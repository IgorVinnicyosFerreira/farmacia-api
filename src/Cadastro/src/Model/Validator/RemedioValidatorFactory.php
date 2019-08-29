<?php

declare(strict_types=1);

namespace Cadastro\Model\Validator;

use Psr\Container\ContainerInterface;

class RemedioValidatorFactory
{
    public function __invoke(ContainerInterface $container) : RemedioValidator
    {
        return new RemedioValidator();
    }
}
