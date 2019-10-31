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


Route::post('/register', "UserController@register");
Route::post('/login', "UserController@login");
Route::middleware('auth:api')->get('/users/{id}', 'UserController@users');

Route::middleware('auth:api')->group(function() {
	Route::apiResource('/prestador', "ProviderController");
	Route::apiResource('/produto', "ProductController");
});
