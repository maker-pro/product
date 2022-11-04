<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
//Route::group(['namespace'=>'Api\Video\V1','prefix' => 'vv1', 'middleware' => ['ip_check']], function () {
Route::group(['namespace'=>'Api\Video\V1','prefix' => 'vv1'], function () {
    Route::get('/test','TestController@phone')->name('test.phone');
});
