<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserApiController;

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

Route::group(['namespace' =>'Api', 'prefix' => 'API'], function(){
	Route::post('userLogin',[UserApiController::class, 'loginAction']);
	Route::group(['middleware' => 'auth:api'], function(){
	   	Route::resource('/contactList', '\App\Http\Controllers\Api\ContactController');
	});
});
