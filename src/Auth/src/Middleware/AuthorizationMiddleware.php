<?php

namespace Auth\Middleware;

use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Expressive\Helper\UrlHelper;

class AuthorizationMiddleware implements MiddlewareInterface
{
    private $authConfig;
    private $urlHelper;

    public function __construct(array $authConfig, UrlHelper $urlHelper)
    {
        $this->authConfig = $authConfig;
        $this->urlHelper = $urlHelper;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    { }
}
