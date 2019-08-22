<?php

declare(strict_types=1);

use Auth\teste\testeHandler;

use Psr\Container\ContainerInterface;
use Zend\Expressive\Application;
use Zend\Expressive\MiddlewareFactory;

/**
 * Setup routes with a single request method:
 *
 * $app->get('/', App\Handler\HomePageHandler::class, 'home');
 * $app->post('/album', App\Handler\AlbumCreateHandler::class, 'album.create');
 * $app->put('/album/:id', App\Handler\AlbumUpdateHandler::class, 'album.put');
 * $app->patch('/album/:id', App\Handler\AlbumUpdateHandler::class, 'album.patch');
 * $app->delete('/album/:id', App\Handler\AlbumDeleteHandler::class, 'album.delete');
 *
 * Or with multiple request methods:
 *
 * $app->route('/contact', App\Handler\ContactHandler::class, ['GET', 'POST', ...], 'contact');
 *
 * Or handling all request methods:
 *
 * $app->route('/contact', App\Handler\ContactHandler::class)->setName('contact');
 *
 * or:
 *
 * $app->route(
 *     '/contact',
 *     App\Handler\ContactHandler::class,
 *     Zend\Expressive\Router\Route::HTTP_METHOD_ANY,
 *     'contact'
 * );
 */
return function (Application $app, MiddlewareFactory $factory, ContainerInterface $container): void {
    //$app->get('/', testeHandler::class, 'home');
    $app->post('/cliente/inserir', Cadastro\Handler\Cliente\InserirHandler::class, 'cliente.inserir');
    $app->put('/cliente/editar', Cadastro\Handler\Cliente\EditarHandler::class, 'cliente.editar');
    $app->get('/cliente', Cadastro\Handler\Cliente\ListarHandler::class, 'cliente');
    $app->delete('/cliente/excluir', Cadastro\Handler\Cliente\DeletarHandler::class, 'cliente.deletar');

    $app->post('/usuario/inserir', Cadastro\Handler\Usuario\InserirHandler::class, 'usuario.inserir');
    $app->put('/usuario/editar', Cadastro\Handler\Usuario\EditarHandler::class, 'usuario.editar');
    $app->get('/usuario', Cadastro\Handler\Usuario\ListarHandler::class, 'usuario');
    $app->delete('/usuario/excluir', Cadastro\Handler\Usuario\DeletarHandler::class, 'usuario.deletar');
};
