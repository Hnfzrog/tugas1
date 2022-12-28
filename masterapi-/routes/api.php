<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AspekController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\Auth\UserController;

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

Route::prefix('aspek')->group(function () {
    Route::post('/save', [AspekController::class,'saveData']);
    Route::get('/get/{id}', [AspekController::class,'getData']);
    Route::get('/load', [AspekController::class,'loadAll']);
    Route::put('/update/{id}', [AspekController::class,'updateData']);
    Route::delete('/delete/{id}', [AspekController::class, 'delete']);
});

Route::prefix('satuan')->group(function()
{
    Route::get('get', [SatuanController::class, 'getAll']);
    Route::post('/update/{id}', [SatuanController::class, 'updateSatuan']);
    Route::post('add', [SatuanController::class, 'newData']);
    Route::get('getId/{id}', [SatuanController::class, 'getById']);
    Route::delete('deleteSatuan/{id}', [SatuanController::class, 'deleteSatuan']);
});
Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);