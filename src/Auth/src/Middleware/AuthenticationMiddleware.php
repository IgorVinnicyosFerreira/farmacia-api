<?php

namespace Auth\Middleware;

use Auth\JWT\JWT;
use Exception;
use PHPUnit\Framework\MockObject\Stub\ReturnCallback;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Expressive\Helper\UrlHelper;

class AuthenticationMiddleware implements MiddlewareInterface
{
    private $authConfig;
    private $JWT;
    private $urlHelper;

    public function __construct(array $authConfig, JWT $JWT, UrlHelper $urlHelper)
    {
        $this->authConfig = $authConfig;
        $this->JWT = $JWT;
        $this->urlHelper = $urlHelper;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            $routeName = $this->urlHelper->getRouteResult()->getMatchedRouteName();

            if (isset($this->authConfig['ignoredRoutes'])) {
                if (in_array($routeName, $this->authConfig['ignoredRoutes']))
                    return $handler->handle($request);
            }

            $token = $this->getToken($request);

            if (!$this->JWT->tokenIsValid($token))
                return new JsonResponse(["error" => "Token inválido"], 401);

            $payload = $this->JWT->getTokenPayload($token);

            $response = $handler->handle($request->withAttribute("token_payload", $payload));

            //novo token com expiração atualizada
            if (isset($this->authConfig['jwt']['expirationTime'])) {
                $newToken = $this->JWT->createToken((array) $payload);
                $response = $response->withHeader("autorizathion", "Bearer {$newToken}");
            }


            return $response;
        } catch (Exception $error) {
            return new JsonResponse(["error" => "Erro ao autenticar usuário"], 401);
        }
    }


    private function getToken(ServerRequestInterface $request): string
    {
        $authorizationHeader = $request->getHeader('authorization');

        if (!$authorizationHeader)
            throw new Exception("Authorization header não informado");

        $token = str_replace("Bearer ", "", $authorizationHeader[0]);

        return $token ?? "";
    }
}
