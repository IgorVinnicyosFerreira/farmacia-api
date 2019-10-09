<?php

declare(strict_types=1);

namespace Cadastro\Model\Validator;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;
use Zend\InputFilter\Factory;
use Zend\Validator\Date;
use Zend\Validator\NotEmpty;
use Zend\Validator\StringLength;

class ClienteValidator implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $factory = new Factory();
        $inputFilter = $factory->createInputFilter([
            "nome"  =>  [
                "name"       =>  "nome",
                "required"   =>  true,
                "validators" =>  [
                    new NotEmpty(),
                    new StringLength(["min" => 2, "max" => 50])
                ],
            ],
            "sobrenome"  =>  [
                "name"       =>  "sobrenome",
                "required"   =>  true,
                "validators" =>  [
                    new NotEmpty(),
                    new StringLength(["min" => 2, "max" => 50])
                ]
            ],
            "sobrenome"  =>  [
                "name"       =>  "sobrenome",
                "required"   =>  true,
                "validators" =>  [
                    new NotEmpty(),
                    new StringLength(["min" => 2, "max" => 50])
                ]
            ],
            "dataNascimento"  =>  [
                "name"       =>  "dataNascimento",
                "required"   =>  true,
                "validators" =>  [
                    new Date()
                ]
            ],
        ]);

        $inputFilter->setData($request->getParsedBody());

        if (!$inputFilter->isValid())
            return new JsonResponse(["campos_invalidos" => $inputFilter->getMessages()], 400);

        $request = $request->withParsedBody($inputFilter->getValues());
        
        return $handler->handle($request);
    }
}
