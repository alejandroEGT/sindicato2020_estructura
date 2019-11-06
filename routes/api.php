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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('auth/register', 'AuthController@register');

Route::post('auth/login', 'AuthController@login');

Route::group(['middleware' => 'jwt.auth'], function(){
  	Route::get('auth/user', 'AuthController@user');
  	Route::post('auth/logout', 'AuthController@logout');

  	Route::get('traer', 'UserController@listar');
  	Route::get('traer2', 'UserController@listar');
  	Route::get('traer3', 'UserController@listar');
  	Route::get('traer4', 'UserController@listar');

  		require 'Rutas_api/alejandro_api.php';
		require 'Rutas_api/sumbex_api.php';
		require 'Rutas_api/david_api.php';
		require 'Rutas_api/rior_api.php';
});
Route::group(['middleware' => 'jwt.refresh'], function(){
  Route::get('auth/refresh', 'AuthController@refresh');
});