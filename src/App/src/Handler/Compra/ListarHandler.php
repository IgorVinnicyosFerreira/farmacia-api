<?php

declare(strict_types=1);

namespace App\Handler\Compra;

use App\Repository\CompraRepository;
use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

class ListarHandler implements RequestHandlerInterface
{
    private $compraRepository;

    public function __construct(CompraRepository $compraRepository)
    {
        $this->compraRepository = $compraRepository;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $params = $request->getQueryParams();

        try {

            if (isset($params['id'])) {
                $compra = $this->compraRepository->find($params['id']);

                if (!$compra) throw new Exception("Não existe uma compra com este id");

                return new JsonResponse($compra);
            }

            $listaCompras = $this->compraRepository->findAll();

            return new JsonResponse($listaCompras);
        } catch (Exception $error) {
            return new JsonResponse(["error" => $error->getMessage()], 400);
        }
    }
}
