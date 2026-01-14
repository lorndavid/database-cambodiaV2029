<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddressPageController;
use App\Http\Controllers\Admin\SubmissionController;

Route::get('/address', [AddressPageController::class, 'show']);
Route::post('/address/submit', [AddressPageController::class, 'submit'])->name('address.submit');

Route::prefix('admin')->group(function () {
    Route::get('/submissions', [SubmissionController::class, 'index']);
    Route::get('/submissions/export', [SubmissionController::class, 'exportCsv']);
});
