<?php

declare(strict_types=1);

namespace Cadastro\Handler\Usuario;

use Auth\Model\Entity\Acesso;
use Cadastro\Model\Entity\Usuario;
use Cadastro\Repository\UsuarioRepository;
use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

class InserirHandler implements RequestHandlerInterface
{

    private $usuarioRepository;

    public function __construct(UsuarioRepository $usuarioRepository)
    {

        $this->usuarioRepository = $usuarioRepository;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $body = $request->getParsedBody();

        try {
            $usuario = new Usuario();

            $usuario->setNome($body['nome'])->setSobrenome($body['sobrenome'])
                ->setEmail($body['email'])->setDataNascimento($body['dataNascimento']);

            $acesso = new Acesso();
            $acesso->setLogin($body['email'])->setSenha($body['senha']);

            $usuario->setAcesso($acesso);

            $this->usuarioRepository->save($usuario);

            return new JsonResponse($usuario);
        } catch (Exception $error) {
            return new JsonResponse(["error" => $error->getMessage()], 400);
        }
    }
}
