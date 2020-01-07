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

Route::get('post/{slug}', ['as' => 'posts.show', 'uses' => 'PostsController@show']);
Route::get('tag/{slug}', ['as' => 'posts.tag', 'uses' => 'PostsController@tag']);

Route::get('rss/posts', ['as' => 'rss.posts', 'uses' => 'RssController@posts']);

Route::get('/', ['as' => 'pages.home', 'uses' => 'PagesController@home']);
