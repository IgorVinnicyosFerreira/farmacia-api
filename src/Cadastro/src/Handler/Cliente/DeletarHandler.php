<?php

declare(strict_types=1);

namespace Cadastro\Handler\Cliente;

use Cadastro\Repository\ClienteRepository;
use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

class DeletarHandler implements RequestHandlerInterface
{
    private $clienteRepository;

    public function __construct(ClienteRepository $clienteRepository)
    {
        $this->clienteRepository = $clienteRepository;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $params = $request->getQueryParams();

        try {
            $this->clienteRepository->delete((int) $params['id']);

            return new JsonResponse([]);
        } catch (Exception $error) {
            return new JsonResponse(["error" => $error->getMessage()], 400);
        }
    }
}
