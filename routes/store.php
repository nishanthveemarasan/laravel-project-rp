<?php

use Illuminate\Support\Facades\Route;

Route::prefix('v1')->middleware(['json.response'])->name('store.v1.')->group(function () {

    Route::get('/hello', function () {
        return 'welcome';
    });
});
