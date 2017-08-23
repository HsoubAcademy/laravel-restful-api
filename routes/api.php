<?php

use Illuminate\Http\Request;

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

Route::group(['prefix' => 'v1'], function(){

    Route::post('login', 'AuthController@login');

    Route::resource('lessons', 'LessonsController');

    Route::get('lessons/{id}/tags', 'TagsController@index');
    Route::resource('tags', 'TagsController', ['only' => ['index', 'show']]);

});


