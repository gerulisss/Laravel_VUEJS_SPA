<?php

use App\Http\Controllers\API\AgentController;
use App\Http\Controllers\API\CreateUserController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');

Route::group(['prefix' => 'users', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [CreateUserController::class, 'index']);
    Route::post('add', [CreateUserController::class, 'add']);
    Route::get('edit/{id}', [CreateUserController::class, 'edit']);
    Route::post('update/{id}', [CreateUserController::class, 'update']);
    Route::delete('delete/{id}', [CreateUserController::class, 'delete']);
});

Route::group(['prefix' => 'agents', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [AgentController::class, 'index']);
    Route::post('add', [AgentController::class, 'add']);
    Route::get('edit/{id}', [AgentController::class, 'edit']);
    Route::post('update/{id}', [AgentController::class, 'update']);
    Route::delete('delete/{id}', [AgentController::class, 'delete']);
});
