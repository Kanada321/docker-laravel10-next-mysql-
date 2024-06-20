<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GuildController;
use App\Http\Controllers\UserController;
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
// ログインと新規登録のルーティング
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// 認証が必要なルート
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'getUser']);
    // ユーザープロファイル関連
    Route::put('/user/profile', [UserController::class, 'updateProfile']);

    // ギルド関連
    Route::prefix('guild')->group(function () {
        Route::post('/', [GuildController::class, 'create']);
        Route::get('/', [GuildController::class, 'index']);
        Route::get('/{id}', [GuildController::class, 'show']);
        Route::get('/fetch-guild/{guild}', [GuildController::class, 'fetchGuild']);
        Route::put('/update/{guild}', [GuildController::class, 'update']);
    });

    // イベント関連
    Route::prefix('events')->group(function () {
        Route::post('/', [EventController::class, 'create']);
        Route::get('/', [EventController::class, 'index']);
        Route::get('/{id}', [EventController::class, 'show']);
        Route::put('/{id}/status', [EventController::class, 'updateStatus']);
    });
});
