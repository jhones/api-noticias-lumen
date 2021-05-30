<?php

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

use App\Models\Author\Author;
use App\Models\ImageNews\ImageNews;
use App\Models\News\News;

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api/v1', 'namespace' => 'V1\Author', 'as' => Author::class], function () use ($router) {
   $router->post('/autores', [
       'uses' => 'AuthorController@create',
       'middleware' => 'ValidateDataMiddleware'
   ]);
   $router->get('/autores', [
       'uses' => 'AuthorController@findAll'
   ]);
   $router->get('/autores/{id}', [
       'uses' => 'AuthorController@findOneBy'
   ]);
   $router->put('/autores/{param}', [
       'uses' => 'AuthorController@editBy',
       'middleware' => 'ValidateDataMiddleware'
   ]);
   $router->patch('/autores/{param}', [
       'uses' => 'AuthorController@editBy',
       'middleware' => 'ValidateDataMiddleware'
   ]);
   $router->delete('/autores/{id}', [
       'uses' => 'AuthorController@delete'
   ]);
});

$router->group(['prefix' => 'api/v1', 'namespace' => 'V1\News', 'as' => News::class], function () use ($router) {
    $router->post('/noticias', [
        'uses' => 'NewsController@create',
        'middleware' => 'ValidateDataMiddleware'
    ]);
    $router->get('/noticias', [
        'uses' => 'NewsController@findAll'
    ]);
    $router->get('/noticias/autor/{author}', [
        'uses' => 'NewsController@findByAuthor'
    ]);
    $router->get('/noticias/{param}', [
        'uses' => 'NewsController@findBy'
    ]);
    $router->put('/noticias/{param}', [
        'uses' => 'NewsController@editBy',
        'middleware' => 'ValidateDataMiddleware'
    ]);
    $router->patch('/noticias/{param}', [
        'uses' => 'NewsController@editBy',
        'middleware' => 'ValidateDataMiddleware'
    ]);
    $router->delete('/noticias/{param}', [
        'uses' => 'NewsController@deleteBy'
    ]);
    $router->delete('/noticias/autor/{author}', [
        'uses' => 'NewsController@deleteByAuthor'
    ]);
});

$router->group(['prefix' => 'api/v1', 'namespace' => 'V1\ImageNews', 'as' => ImageNews::class], function () use ($router) {
    $router->post('/imagens-noticias', [
        'uses' => 'ImageNewsController@create',
        'middleware' => 'ValidateDataMiddleware'
    ]);
    $router->get('/imagens-noticias', [
        'uses' => 'ImageNewsController@findAll'
    ]);
    $router->get('/imagens-noticias/noticia/{news}', [
        'uses' => 'ImageNewsController@findByNews'
    ]);
    $router->get('/imagens-noticias/{id}', [
        'uses' => 'ImageNewsController@findOneBy'
    ]);
    $router->put('/imagens-noticias/{param}', [
        'uses' => 'ImageNewsController@editBy',
        'middleware' => 'ValidateDataMiddleware'
    ]);
    $router->patch('/imagens-noticias/{param}', [
        'uses' => 'ImageNewsController@editBy',
        'middleware' => 'ValidateDataMiddleware'
    ]);
    $router->delete('/imagens-noticias/noticia/{news}', [
        'uses' => 'ImageNewsController@deleteByNews'
    ]);
    $router->delete('/imagens-noticias/{id}', [
        'uses' => 'ImageNewsController@delete'
    ]);
});
