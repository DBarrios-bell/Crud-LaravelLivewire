<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\Api\ExpenseController;
use App\Http\Controllers\API\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*Route::group(["prefix" => "auth"], function(){
    Route::post('/login',[AuthController::class,"login"]);
    Route::post('/logout',[AuthController::class,"logout"]);
});*/

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class,'login']);
    Route::post('logout', [AuthController::class,'logout']);
    Route::post('refresh', [AuthController::class,'refresh']);
    Route::post('me', [AuthController::class,'me']);
});


Route::group(['middleware' => ['isLogged']], function(){

    Route::group(['prefix'=>'user'], function(){
        Route::get('/',[UserController::class,'index']);
        Route::post('/',[UserController::class,'create']);
        Route::get('/rol',[UserController::class,'rol']);
        Route::get('/{id}',[UserController::class,'show']);
        Route::patch('/{id}',[UserController::class,'update']);
        Route::delete('/{id}',[UserController::class,'destroy']);
    });

    Route::group(['prefix'=>'expense'], function(){
        Route::get('/',[ExpenseController::class,'index']);
        Route::post('/',[ExpenseController::class,'create']);
        Route::get('/{id}',[ExpenseController::class,'show']);
        Route::patch('/{id}',[ExpenseController::class,'update']);
        Route::delete('/{id}',[ExpenseController::class,'destroy']);
    });

});


