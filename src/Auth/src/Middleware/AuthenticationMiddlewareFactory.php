<?php

declare(strict_types=1);

namespace Auth\Middleware;

use Auth\JWT\JWT;
use Psr\Container\ContainerInterface;
use Zend\Expressive\Helper\UrlHelper;

class AuthenticationMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): AuthenticationMiddleware
    {

        $authConfig = isset($container->get('config')['authConfig'])
            ? $container->get('config')['authConfig']
            : [];

        $JWT = $container->get(JWT::class);

        $urlHelper = $container->get(UrlHelper::class);
        return new AuthenticationMiddleware($authConfig, $JWT, $urlHelper);
    }
}
