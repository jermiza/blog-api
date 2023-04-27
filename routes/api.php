<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Guest Routes -------
Route::middleware('guest')->group(function () {
    Route::post('/admin/login', [AuthController::class, 'logIn'])->name('admin.login');
});

// Auth Routes --------
Route::middleware('auth:sanctum')->prefix('admin')->as('admin.')->group(function () {
    // Auth Routes -------
    Route::post('/logout', [AuthController::class, 'logOut'])->name('login');

    //Category Routes -------
    Route::apiResource('/category', CategoryController::class)->names('category');

    //Post Routes -------
    Route::apiResource('/post', PostController::class)->names('post');
});
