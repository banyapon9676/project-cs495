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
//API
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout']);


// Public
Route::get('/product', [App\Http\Controllers\Productroller::class, 'index']);
Route::get('/product/show/{id}', [App\Http\Controllers\Productroller::class, 'show']);
Route::get('/product/search/{name}', [App\Http\Controllers\Productroller::class, 'search']);


// Protect
Route::group(['middleware'=>['auth:sanctum']], function(){
    Route::middleware('auth:sanctum')->post('/product/store', [App\Http\Controllers\Productroller::class, 'store']);
    Route::middleware('auth:sanctum')->post('/product/update', [App\Http\Controllers\Productroller::class, 'update']);
    Route::delete('/product/{id}', [App\Http\Controllers\Productroller::class, 'delete']);

    Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout']);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
