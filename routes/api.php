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

Route::apiResource('posts', 'Api\PostsController');
Route::apiResource('tags', 'Api\TagsController');
Route::get('tags/{id}/posts', 'Api\TagsController@posts');