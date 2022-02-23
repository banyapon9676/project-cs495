<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Productroller;

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



// Public
Route::get('/product', [Productroller::class, 'index']);
Route::get('/product/show/{id}', [Productroller::class, 'show']);
Route::get('/product/search/{name}', [Productroller::class, 'search']);


// Protect
Route::group(['middleware'=>['auth:sanctum']], function(){
    Route::post('/product/store', [Productroller::class, 'store']);
    Route::post('/product/update/{id}', [Productroller::class, 'update']);
    Route::delete('/product/delete/{id}', [Productroller::class, 'destroy']);

    Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout']);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
