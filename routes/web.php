<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

Route::middleware(['admin_auth'])->group(function () {
    Route::redirect('/', 'loginPage');
    Route::get('/loginPage',[AuthController::class,'loginPage'])->name('auth#loginPage');
    Route::get('/registerPage',[AuthController::class,'registerPage'])->name('auth#registerPage');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard',[AuthController::class,'dashboard'])->name('dashboard');
});

Route::middleware(['admin_auth'])->group(function () {
    //category
    Route::prefix('category')->group(function(){
        Route::get('list',[CategoryController::class,'categoryList'])->name('category#list');
        Route::get('create',[CategoryController::class,'categoryCreate'])->name('category#create');
        Route::post('created',[CategoryController::class,'createdCategory'])->name('category#created');
        Route::get('delete/{id}',[CategoryController::class,'categoryDelete'])->name('category#delete');
        Route::get('edit/{id}',[CategoryController::class,'edit'])->name('category#edit');
        Route::post('update',[CategoryController::class,'update'])->name('category#update');
    });
});


Route::middleware(['user_auth'])->group(function () {
    //category
    Route::prefix('product')->group(function(){
        Route::get('list',[ProductController::class,'productList'])->name('product#list');
    });
});


