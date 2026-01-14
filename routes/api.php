<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AddressController;

Route::prefix('address')->group(function () {
    Route::get('/provinces', [AddressController::class, 'provinces']);
    Route::get('/districts', [AddressController::class, 'districts']);
    Route::get('/communes',  [AddressController::class, 'communes']);
    Route::get('/villages',  [AddressController::class, 'villages']);

    // ✅ search
    Route::get('/search-villages', [AddressController::class, 'searchVillages']);
});
