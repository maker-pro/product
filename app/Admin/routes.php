<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {
    $router->get('/', 'HomeController@report');

    $router->get('/home', 'HomeController@index')->name('home');
    // video
    $router->resource('/product/video', 'VideoController');
    // fiction
    $router->resource('/product/fiction', 'FictionController');


    // admin api
    $router->post('/api-v1/get_fiction_chapter', 'ApiController@getFictionChapter');
    $router->get('/api-v1/get_chapter_content', 'ApiController@getChapterContent');
    // admin api end
});
