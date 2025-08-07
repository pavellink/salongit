<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['cabinet'])->controller(\App\Http\Controllers\Cabinet\CabinetController::class)->group(function () {
    Route::get('/cabinet', 'index')->name('cabinet');
});

Route::middleware(['cabinet'])->controller(\App\Http\Controllers\Cabinet\VerifiController::class)->group(function () {
    Route::get('/verifi', 'index')->name('verifi');
    Route::post('/verifi/user-confirm', 'userConfirm')->name('verifi.user.confirm');
    Route::post('/verifi/phone', 'phone')->name('verifi.phone');
    Route::post('/verifi/phone-confirm', 'phoneConfirm')->name('verifi.phone.confirm');
});

Route::controller(\App\Http\Controllers\Cabinet\VerifiController::class)->group(function () {
    Route::get('/vk', 'vk');
    Route::get('/vk-callback', 'vkCallback');
});

