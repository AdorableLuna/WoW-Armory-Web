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

Route::get('/', ['as' => 'realm', 'uses' => 'RealmController@index']);
Route::get('/{region}', ['as' => 'servers', 'uses' => 'ServersController@index']);
Route::get('/{region}/{server}/{charactername}', ['as' => 'character', 'uses' => 'CharacterController@index']);
Route::get('/{region}/{server}/{charactername}/collections', ['as' => 'collections', 'uses' => 'CharacterController@collection']);