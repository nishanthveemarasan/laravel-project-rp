<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->name('api.v1.')->group(function () {

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index'); //api.v1.users.index
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::get('/{user:uuid}', [UserController::class, 'edit'])->name('edit');
        Route::patch('/{user:uuid}', [UserController::class, 'update'])->name('update');
        Route::delete('/{user:uuid}', [UserController::class, 'destroy'])->name('destroy');
        Route::get('/restore/{user:uuid}', [UserController::class, 'restore'])->name('restore');
    });
});
