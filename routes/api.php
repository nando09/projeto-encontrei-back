<?php

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
// use App\Http\Controllers\UserController;

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

Route::middleware('auth:api')->get('/users/{id}', 'UserController@users');

Route::post('/register', "UserController@register");
Route::post('/login', "UserController@login");

Route::post('/register_web', "UserController@registerWeb");
Route::post('/login_web', "UserController@loginWeb");

Route::post('/register_app', "UserController@registerApp");
Route::post('/login_app', "UserController@loginApp");

Route::get('/mercadoPago', "MercadoPagamento@ver");

Route::middleware('auth:api')->group(function() {
	Route::apiResource('/prestador', "ProviderController");
	Route::apiResource('/produto', "ProductController");
	Route::apiResource('/plano-servico', "ServicePlanController");
	Route::get('/productsProvider/{id}', "ProductController@productsProvider");
});
