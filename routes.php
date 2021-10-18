<?php
use App\Core\Route;

Route::add('/', 'DefaultController@index');

// User route
Route::add('/user', 'UserController@index');
Route::add('/user/list', 'UserController@getList');
Route::add('/user/get', 'UserController@getRow');
Route::add('/user/insert', 'UserController@create');
Route::add('/user/update', 'UserController@update');
Route::add('/user/delete', 'UserController@destroy');

Route::dispatch();