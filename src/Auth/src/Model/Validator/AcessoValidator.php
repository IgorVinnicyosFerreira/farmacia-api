<?php

declare(strict_types=1);

namespace Auth\Model\Validator;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Filter\StringTrim;
use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;
use Zend\Validator\NotEmpty;
use Zend\Validator\StringLength;

class AcessoValidator implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $inputFilter = new InputFilter();

        $login = new Input('login');
        $login->getFilterChain()->attach(new StringTrim());
        $login->getValidatorChain()->attach(new NotEmpty());
        $inputFilter->add($login);

        $senha = new Input('senha');
        $senha->getFilterChain()->attach(new StringTrim());
        $senha->getValidatorChain()->attach(new NotEmpty())
            ->attach(new StringLength(['min' => 6]));
        $inputFilter->add($senha);

        $inputFilter->setData($request->getParsedBody());

        if (!$inputFilter->isValid())
            return new JsonResponse(["campos_invalidos" => $inputFilter->getMessages()], 400);

        return $handler->handle($request);
    }
}
