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
Route::post('auth/login', 'Api\AuthController@login')->name('login');
Route::post('auth/register', 'Api\AuthController@register')->name('auth.register');

// ROUTE GROUP
Route::group(['middleware' => ['apiJwt']], function () {

  Route::post('auth/logout', 'Api\AuthController@logout')->name('logout');
  Route::post('auth/refresh', 'Api\AuthController@refresh');
  Route::get('auth/me', 'Api\AuthController@me');

  Route::get('users', 'Api\UserController@index')->name('users');
  Route::get('users/{id}', 'Api\UserController@show')->name('users.show');
  Route::post('users/store', 'Api\UserController@store')->name('users.store');
  Route::patch('users/update/{id}', 'Api\UserController@update')->name('users.update');
  Route::delete('users/delete/{id}', 'Api\UserController@destroy')->name('users.delete');

  Route::get('products', 'Api\ProductsController@index')->name('products');
  Route::get('products/{id}', 'Api\ProductsController@show')->name('products.show');
  Route::post('products/store', 'Api\ProductsController@store')->name('products.store');
  Route::patch('products/update/{id}', 'Api\ProductsController@update')->name('products.update');
  Route::delete('products/delete/{id}', 'Api\ProductsController@destroy')->name('products.delete');

});
