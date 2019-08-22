<?php

declare(strict_types=1);

namespace Cadastro\Handler\Usuario;

use Cadastro\Repository\UsuarioRepository;
use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

class ListarHandler implements RequestHandlerInterface
{

    private $usuarioRepository;

    public function __construct(UsuarioRepository $usuarioRepository)
    {

        $this->usuarioRepository = $usuarioRepository;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $params = $request->getQueryParams();
        try {

            if (isset($params['id'])) {
                $usuario = $this->usuarioRepository->find($params['id']);

                if (!$usuario) throw new Exception("Usuario não encontrado");

                return new JsonResponse($usuario);
            }

            $listaUsuario = $this->usuarioRepository->findAll();

            return new JsonResponse($listaUsuario);
        } catch (Exception $error) {
            return new JsonResponse(["error" => $error->getMessage()], 400);
        }
    }
}
