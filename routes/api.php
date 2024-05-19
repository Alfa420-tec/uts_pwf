<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;

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

Route::middleware('auth:api')->group(function () {
    Route::get('/user', function(Request $request) {
        return $request->user();
    });
});

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('profile', [ProfileController::class, 'show']);
    Route::post('logout', [AuthController::class, 'logout']);

    Route::group(['middleware' => ['role:admin']], function () {
        Route::get('admin/profiles', [ProfileController::class, 'index']);
        Route::put('admin/profile/{id}', [ProfileController::class, 'update']);
        Route::delete('admin/profile/{id}', [ProfileController::class, 'destroy']);
    });
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

