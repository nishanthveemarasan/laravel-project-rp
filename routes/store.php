<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Store\CacheController;

Route::name('store.v1.')->group(function () {

    Route::get('/test', function () {
        return 'welcome';
    });
    Route::prefix('products')->name('products.')->group(function () {
        Route::get('/{row}', [ProductController::class, 'index'])->name('index');
        Route::get('/{product:uuid}', [ProductController::class, 'edit'])->name('edit');
    });

    Route::prefix('cache')->name('cache.')->group(function () {

        Route::prefix('cart')->name('cart.')->group(function () {
            Route::post('/', [CacheController::class, 'addCacheCartItem']);
            Route::get('/get', [CacheController::class, 'orderCart']);
            Route::prefix('delete')->name('delete.')->group(function () {
                Route::delete('/', [CacheController::class, 'deleteCart']);
                Route::delete('/item', [CacheController::class, 'removeCacheCartItem']);
                Route::delete('/item/{uuid?}', [CacheController::class, 'removeCacheCartItem']);
            });
        });

        Route::prefix('customer')->name('customer.')->group(function () {
            Route::get('/', [CacheController::class, 'getCacheCustomer']);
            Route::post('/', [CacheController::class, 'cacheCustomer']);
        });
    });
});
