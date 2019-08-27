<?php

declare(strict_types=1);

namespace Cadastro\Handler\Remedio;

use Cadastro\Repository\RemedioRepository;
use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

class DeletarHandler implements RequestHandlerInterface
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
            $this->remedioRepository->delete((int) $params['id']);

            return new JsonResponse([]);
        } catch (Exception $error) {
            return new JsonResponse(["error" => $error->getMessage()], 400);
        }
    }
}
