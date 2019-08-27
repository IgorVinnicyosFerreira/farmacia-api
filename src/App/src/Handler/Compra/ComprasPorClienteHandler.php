<?php

declare(strict_types=1);

namespace App\Handler\Compra;

use Cadastro\Repository\ClienteRepository;
use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

class ComprasPorClienteHandler implements RequestHandlerInterface
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
            $listaCompras = $this->clienteRepository->comprasPorCliente((int) $params['idCliente']);

            return new JsonResponse($listaCompras);
        } catch (Exception $error) {
            return new JsonResponse(["error" => $error->getMessage()], 400);
        }
    }
}
