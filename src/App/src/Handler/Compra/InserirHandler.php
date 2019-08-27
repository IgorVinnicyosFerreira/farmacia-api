<?php

declare(strict_types=1);

namespace App\Handler\Compra;

use App\Repository\CompraRepository;
use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

class InserirHandler implements RequestHandlerInterface
{
    private $compraRepository;

    public function __construct(CompraRepository $compraRepository)
    {
        $this->compraRepository = $compraRepository;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $body = $request->getParsedBody();

        try {
            $this->compraRepository
                ->save($body['idUsuario'], $body['idRemedio'], $body['idCliente']);

            return new JsonResponse([]);
        } catch (Exception $error) {
            return new JsonResponse(["error" => $error->getMessage()], 400);
        }
    }
}
