<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('posts/' ,[PostController::class , 'index']);
Route::get('post/{id}' ,[PostController::class , 'show']);
Route::Post('posts/create' ,[PostController::class , 'store']);
Route::delete('post/delete/{id}' ,[PostController::class , 'destroy']);
Route::Put('post/update/{id}' ,[PostController::class , 'update']);
Route::group([

    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers',

], function ($router) {

    Route::post('login', [AuthController::class ,'login' ]);
//    Route::post('logout', 'AuthController@logout');
//    Route::post('refresh', 'AuthController@refresh');
    Route::get('me', [AuthController::class , 'me']);

});
