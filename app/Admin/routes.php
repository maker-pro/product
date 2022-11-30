<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {
    $router->get('/', 'HomeController@index')->name('home');
    $router->get('/product/video', 'VideoController@index')->name('admin-video');
    $router->get('/product/video/{id}', 'VideoController@detail')->where(['id' => '[0-9]+']);
    $router->get('/product/video/{id}/edit', 'VideoController@edit')->where(['id' => '[0-9]+']);
});
