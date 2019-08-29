<?php

declare(strict_types=1);

namespace Cadastro\Model\Validator;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Filter\StripTags;
use Zend\InputFilter\Factory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\Date;
use Zend\Validator\EmailAddress;
use Zend\Validator\NotEmpty;
use Zend\Validator\StringLength;

class UsuarioValidator implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {

        $factory = new Factory();

        $inputFilter = $factory->createInputFilter([
            "nome" => [
                'name' => 'nome',
                'required' => true,
                'validators' => [
                    new NotEmpty(),
                    new StringLength(['min' => 2, 'max' => 50])
                ],
                'filters' => [
                    new StripTags(),
                ]
            ],
            'sobrenome' => [
                'name' => 'nome',
                'required' => true,
                'validators' => [
                    new NotEmpty(),
                    new StringLength(['min' => 2, 'max' => 50])
                ],
                'filters' => [
                    new StripTags(),
                ]
            ],
            'dataNascimento' => [
                'name' => 'dataNascimento',
                'required' => true,
                'validator' => [
                    new Date(),
                ]
            ],
            'email' => [
                'name' => 'email',
                'required'  => true,
                'validator' => [
                    new NotEmpty(),
                    new EmailAddress(),
                ]
            ],
        ]);

        $inputFilter->setData($request->getParsedBody());

        if (!$inputFilter->isValid())
            return new JsonResponse(['campos_invalidos' => $inputFilter->getMessages()]);

        return $handler->handle($request);
    }
}
