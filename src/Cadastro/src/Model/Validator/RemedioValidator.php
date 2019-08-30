<?php

declare(strict_types=1);

namespace Cadastro\Model\Validator;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Filter\StripTags;
use Zend\Filter\ToFloat;
use Zend\InputFilter\Factory;
use Zend\Validator\Callback;
use Zend\Validator\NotEmpty;
use Zend\Validator\StringLength;

class RemedioValidator implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $factory = new Factory();
        $inputFilter = $factory->createInputFilter([
            "nome"  =>  [
                "name"          =>  "nome",
                "required"      =>  true,
                "validators"    =>  [
                    new NotEmpty(),
                    new StringLength(["min" => 3, "max" => 100])
                ],
                "filters"       =>  [
                    new StripTags()
                ]
            ],
            "descricao"  =>  [
                "name"          =>  "descricao",
                "required"      =>  true,
                "validators"    =>  [
                    new NotEmpty(),
                    new StringLength(["min" => 5, "max" => 500])
                ],
                "filters"       =>  [
                    new StripTags()
                ]
            ],
            "preco"  =>  [
                "name"          =>  "preco",
                "required"      =>  true,
                "validators"    =>  [
                    new NotEmpty([NotEmpty::INTEGER | NotEmpty::FLOAT, NotEmpty::ZERO]),
                    (new Callback(function ($value) {

                        if (!is_float($value))
                            return false;

                        return true;
                    }))->setMessage("Formato inválido", Callback::INVALID_VALUE)
                ],

            ],

        ]);

        $inputFilter->setData($request->getParsedBody());

        if (!$inputFilter->isValid())
            return new JsonResponse(["campos_invalidos" => $inputFilter->getMessages()], 400);

        return $handler->handle($request);
    }
}
