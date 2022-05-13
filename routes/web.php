<?php

use Illuminate\Support\Facades\Route;
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
    Route::get('/', [IndexController::class, 'index']);
    Route::get('/addGoods', [AddGoodsController::class, 'index']);
    Route::post('/addGoodsAction', [AddGoodsController::class, 'addGoodsAction']);

    Route::post('/searchGoodsAjax', [IndexController::class, 'searchGoodsAjax']);
    Route::post('/getGoodsAjax', [IndexController::class, 'getGoodsAjax']);
    Route::post('/setGoodsAjax', [IndexController::class, 'setGoodsAjax']);
    Route::post('/delGoodsAjax', [IndexController::class, 'delGoodsAjax']);
    Route::post('/monitoringGoodsAjax', [IndexController::class, 'monitoringGoodsAjax']);
    Route::post('/checkoutGoodsAjax', [IndexController::class, 'checkoutGoodsAjax']);
});
