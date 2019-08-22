<?php

declare(strict_types=1);

namespace Cadastro\Handler\Cliente;

use Cadastro\Model\Entity\Cliente;
use Cadastro\Repository\ClienteRepository;
use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

class InserirHandler implements RequestHandlerInterface
{

    private $clienteRepository;

    public function __construct(ClienteRepository $clienteRepository)
    {
        $this->clienteRepository = $clienteRepository;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {

        $body = $request->getParsedBody();

        $cliente = new Cliente();

        try {
            $cliente->setNome($body['nome'])->setSobrenome($body['sobrenome'])
                ->setDataNascimento($body['dataNascimento']);

            $this->clienteRepository->save($cliente);
            return new JsonResponse($cliente);
        } catch (Exception $error) {
            return new JsonResponse(["erro" => $error->getMessage()], 400);
        }
    }
}
