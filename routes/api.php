<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PosClientController;
use App\Http\Controllers\PosBookController;
use App\Http\Controllers\PosOrderController;

Route::prefix('v1')->group(function () {
    
    Route::apiResource('clients', PosClientController::class);

    Route::apiResource('books', PosBookController::class);

    Route::post('orders/purchase', [PosOrderController::class, 'purchase'])->name('orders.purchase');

});