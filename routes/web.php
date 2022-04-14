<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AddGoodsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['check.login'])->group(function () {
    Route::get('/register', [AuthController::class, 'showRegisterPage'])->withoutMiddleware(['check.login']);
    Route::get('/login', [AuthController::class, 'showLoginPage'])->withoutMiddleware(['check.login']);
    Route::post('/doRegister', [AuthController::class, 'doRegister'])->withoutMiddleware(['check.login']);
    Route::post('/doLogin', [AuthController::class, 'doLogin'])->withoutMiddleware(['check.login']);
    Route::get('/logout', [AuthController::class, 'doLogout'])->withoutMiddleware(['check.logout']);

    Route::get('/', [IndexController::class, 'index']);
    Route::get('/addGoods', [AddGoodsController::class, 'index']);
    Route::post('/addGoodsAction', [AddGoodsController::class, 'addGoodsAction']);
});
