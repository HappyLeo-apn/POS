<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;



//Login //Register

Route::middleware('admin_auth')->group(function(){
    Route::redirect('/', 'loginPage');
    Route::get('loginPage', [AuthController::class, 'loginPage'])->name('auth#loginPage');
    Route::get('registerPage', [AuthController::class, 'registerPage'])->name('auth#registerPage');
});


Route::middleware(['auth'])->group(function () {

    //dashboard
    Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    //Admin
    Route::middleware(['admin_auth'])->group(function(){
        Route::prefix('category')->group( function () {
            Route::get('list', [CategoryController::class, 'list'])->name('category#list');
            Route::get('create/page', [CategoryController::class, 'createPage'])->name('category#createPage');
            Route::post('create', [CategoryController::class, 'create'])->name('category#create');
            Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('category#delete');
            Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('cateogry#edit');
            Route::post('update', [CategoryController::class, 'update'])->name('category#update');
        });
        Route::prefix('admin')->group(function(){
            //Password 
            Route::get('password/changePage', [AdminController::class, 'changePasswordPage'])->name('admin#changePasswordPage');
            Route::post('change/password', [AdminController::class, 'changePassword'])->name('admin#changePassword');
            //Account Profile
            Route::get('details', [AdminController::class, 'details'])->name('admin#details');
            Route::get('edit',[AdminController::class, 'edit'])->name('admin#edit');
            Route::post('update/{id}', [AdminController::class, 'update'])->name('admin#update');

            //Product 
            Route::prefix('products')->group(function(){
                Route::get('list', [ProductController::class, 'list'])->name('product#list');
                Route::get('create', [ProductController::class, 'createPage'])->name('product#createPage');
                Route::post('create', [ProductController::class, 'create'])->name('product#create');
            });
            
        });
    });
    //Admim Category
    

    Route::group(['prefix' => 'user', 'middleware' => 'user_auth'], function(){
        Route::get('home', function(){
            return view('user.home');
        })->name('user#home');
    });
});


//User