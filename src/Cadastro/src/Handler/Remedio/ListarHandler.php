<?php

declare(strict_types=1);

namespace Cadastro\Handler\Remedio;

use Cadastro\Repository\RemedioRepository;
use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

class ListarHandler implements RequestHandlerInterface
{

    private $remedioRepository;

    public function __construct(RemedioRepository $remedioRepository)
    {
        $this->remedioRepository = $remedioRepository;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $params = $request->getQueryParams();

        try {
            if (isset($params['id'])) {
                $remedio = $this->remedioRepository->find($params['id']);

                if (!$remedio) throw new Exception("Não existe um remédio para este id");

                return new JsonResponse($remedio);
            }

            $listaRemedio = $this->remedioRepository->findAll();

            return new JsonResponse($listaRemedio);
        } catch (Exception $error) {
            return new JsonResponse(["error" => $error->getMessage()]);
        }
    }
}
