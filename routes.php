<?php
use App\Core\Route;

Route::add('/', 'DefaultController@index');
Route::add('/user', 'UserController@index');

Route::dispatch();