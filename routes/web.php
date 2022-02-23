<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->post('v1/login', 'AuthController@login');
$router->post('v1/admin/login', 'AdminController@login');

$router->get('/', function () use ($router) {
    return env('DB_HOST', 'no');
});


$router->group(['prefix' => 'v1/empresa'], function () use ($router) {
    $router->get('/',        'EmpresaController@index');
    $router->get('/{id}',    'EmpresaController@show');
    $router->post('/',       'EmpresaController@store');
    $router->post('/{id}',   'EmpresaController@update');
    $router->delete('/{id}', 'EmpresaController@destroy');
});

$router->group(['prefix' => 'v1/categoria'], function () use ($router) {
    $router->get('/',        'CategoriaController@index');
    $router->get('/{id}',    'CategoriaController@show');
    $router->post('/',       ['uses' => 'CategoriaController@store']);
    $router->post('/{id}',   ['middleware' => 'App\Http\Middleware\ProtectedRouteMiddleware', 'uses' => 'CategoriaController@update']);
    $router->delete('/{id}', ['uses' => 'CategoriaController@destroy']);
});

$router->group(['prefix' => 'v1/usuario'], function () use ($router) {
    $router->get('/',          'UsuarioController@index');
    $router->get('/{id}',      'UsuarioController@show');
    $router->post('/cadastro', 'UsuarioController@store');
    $router->post('/{id}',     'UsuarioController@update');
    $router->delete('/{id}',   'UsuarioController@destroy');
});

$router->group(['prefix' => 'v1/admin'], function () use ($router) {
    $router->get('/',        'AdminController@index');
    $router->get('/{id}',    'AdminController@show');
    $router->post('/',       'AdminController@store');
    $router->post('/{id}',   'AdminController@update');
    $router->delete('/{id}', 'AdminController@destroy');
});

$router->group(['prefix' => 'v1/cupom'], function () use ($router) {
    $router->get('/',        'CupomController@index');
    $router->get('/{id}',    'CupomController@show');
    $router->post('/',       'CupomController@store');
    $router->post('/{id}',   'CupomController@update');
    $router->delete('/{id}', 'CupomController@destroy');
});

$router->group(['prefix' => 'v1/produto'], function () use ($router) {
    $router->get('/',        'ProdutoController@index');
    $router->get('/{id}',    'ProdutoController@show');
    $router->post('/',       'ProdutoController@store');
    $router->post('/{id}',   'ProdutoController@update');
    $router->delete('/{id}', 'ProdutoController@destroy');
    $router->get('/por-empresa/{id}', 'ProdutoController@GetByEmpresaID');
});