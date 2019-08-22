<?php

declare(strict_types=1);

namespace Cadastro\Handler\Usuario;

use Cadastro\Model\Entity\Usuario;
use Cadastro\Repository\UsuarioRepository;
use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

class EditarHandler implements RequestHandlerInterface
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

            $usuario->setId($body['id'])->setNome($body['nome'])
                ->setSobrenome($body['sobrenome'])
                ->setDataNascimento($body['dataNascimento'])
                ->setEmail($body['email']);

            $this->usuarioRepository->save($usuario);

            return new JsonResponse([]);
        } catch (Exception $error) {
            return new JsonResponse(["error" => $error->getMessage()]);
        }
    }
}
