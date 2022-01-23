<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
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


Route::prefix('v1')->middleware(['json.response'])->name('api.v1.')->group(function () {

    Route::post('/login', [LoginController::class, 'login'])->name('login');

    Route::middleware('auth:api')->group(function () {

        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('index'); //api.v1.users.index
            Route::post('/store', [UserController::class, 'store'])->name('store');
            Route::get('/{user:uuid}', [UserController::class, 'edit'])->name('edit');
            Route::patch('/{user:uuid}', [UserController::class, 'update'])->name('update');
            Route::delete('/{user:uuid}', [UserController::class, 'destroy'])->name('destroy');
            Route::get('/restore/{user:uuid}', [UserController::class, 'restore'])->withTrashed()->name('restore');
        });



        Route::prefix('posts')->name('posts.')->group(function () {
            Route::get('/users/all', [PostController::class, 'index'])->name('index');
            Route::prefix('user')->name('user.')->group(function () {
                Route::get('/all', [PostController::class, 'ownPosts'])->name('ownPosts');
                Route::get('/{user:uuid}/all', [PostController::class, 'userPosts'])->name('userPosts');
                Route::get('/{post:uuid}', [PostController::class, 'edit'])->name('edit');
                Route::patch('/{post:uuid}', [PostController::class, 'update'])->name('update');
                Route::delete('/{post:uuid}', [PostController::class, 'destroy'])->name('destroy');
                Route::get('/restore/{post:uuid}', [PostController::class, 'restore'])->withTrashed()->name('restore');
            });
            Route::post('/store', [PostController::class, 'store'])->name('store');
        });
        Route::prefix('permissions')->name('permissions.')->group(function () {
            Route::post('/add', [PermissionController::class, 'add'])->name('add');
            Route::post('/remove', [PermissionController::class, 'remove'])->name('add');
        });
    });
});
