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

Route::post('login', 'UserController@login');
Route::post('register', 'UserController@register');
Route::post('contracts', 'ContractController@store');
Route::get('contracts/{id}/sign', 'ContractController@update');
Route::get('contracts', 'ContractController@index');
Route::get('dummy', 'ContractController@dummy');
Route::post('device', 'UserController@device');