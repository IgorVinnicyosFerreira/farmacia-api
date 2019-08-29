<?php

declare(strict_types=1);

namespace Auth\Middleware;

use Psr\Container\ContainerInterface;
use Zend\Expressive\Helper\UrlHelper;

class AuthorizationMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): AuthorizationMiddleware
    {

        $authConfig = isset($container->get('config')['authConfig'])
            ? $container->get('config')['authConfig']
            : [];

        $urlHelper = $container->get(UrlHelper::class);
        return new AuthorizationMiddleware($authConfig, $urlHelper);
    }
}
