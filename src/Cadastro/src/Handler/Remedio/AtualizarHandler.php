<?php

declare(strict_types=1);

namespace Cadastro\Handler\Remedio;

use Cadastro\Model\Entity\Remedio;
use Cadastro\Repository\RemedioRepository;
use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

class AtualizarHandler implements RequestHandlerInterface
{

    private $remedioRepository;

    public function __construct(RemedioRepository $remedioRepository)
    {
        $this->remedioRepository = $remedioRepository;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $body = $request->getParsedBody();

        try {
            $remedio = new Remedio();

            $remedio->setNome($body['nome'])->setDescricao($body['descricao'])
                ->setPreco((float) $body['preco'])->setId($body['id']);

            $this->remedioRepository->save($remedio);

            return new JsonResponse($remedio);
        } catch (Exception $error) {
            return new JsonResponse(["error" => $error->getMessage()], 400);
        }
    }
}
