<?php

declare(strict_types=1);

namespace Auth\Handler\Acesso;

use Auth\JWT\JWT;
use Auth\Repository\AcessoRepository;
use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

class LoginHandler implements RequestHandlerInterface
{
    private $jwtUtil;
    private $acessoRepository;

    public function __construct(JWT $jwtUtil, AcessoRepository $acessoRepository)
    {
        $this->jwtUtil = $jwtUtil;
        $this->acessoRepository = $acessoRepository;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $body = $request->getParsedBody();
        try {

            $usuario = $this->acessoRepository->login($body['login'], $body['senha']);

            $token = $this->jwtUtil->createToken(["usuario" => $usuario->jsonSerialize()]);

            return $this->jwtUtil->tokenResponse($token);
        } catch (Exception $error) {
            return new JsonResponse(["error" => $error->getMessage()], 400);
        }
    }
}
