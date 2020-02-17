<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//显示phpinfo
Route::get('/phpinfo',function(){
    phpinfo();
});
//测试

Route::prefix('test')->group(function (){
    Route::get('/redis','TestController@testRedis');
    Route::get('/wx','TestController@token');
    Route::get('/curl','TestController@curl1');
    Route::get('/curl2','TestController@curl2');
    Route::get('/guzzle','TestController@guzzle1');
    Route::any('/post1','TestController@post1');
    Route::any('/post2','TestController@post2');
});
Route::get('/goods','GoodsController@shop');
//api
Route::prefix('api')->group(function (){
    Route::get('/user/info','Api\UserController@info');
    Route::post('/user/reg','Api\UserController@reg');
});