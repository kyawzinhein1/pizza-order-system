<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserController;


// login , register
Route::middleware(['admin_auth'])->group(function(){
    Route::redirect('/', 'loginPage');
    Route::get('loginPage',[AuthController::class,'loginPage'])->name('auth#loginPage');
    Route::get('registerPage',[AuthController::class,'registerPage'])->name('auth#registerPage');
});

Route::middleware(['auth'])->group(function () {

    // dashboard
    Route::get('dashboard',[AuthController::class,'dashboard'])->name('dashboard');

    // admin
    Route::middleware(['admin_auth'])->group(function () {
        // category
        Route::prefix('category')->group(function(){
            Route::get('list',[CategoryController::class,'list'])->name('category#list');
            Route::get('create',[CategoryController::class,'createPage'])->name('category#createPage');
            Route::post('create',[CategoryController::class,'create'])->name('category#create');
            Route::get('delete/{id}',[CategoryController::class,'delete'])->name('category#delete');
            Route::get('edit/{id}',[CategoryController::class,'edit'])->name('category#edit');
            Route::post('update',[CategoryController::class,'update'])->name('category#update');
        });

        // admin account
        Route::prefix('admin')->group(function(){
            // password
            Route::get('password/changePage',[AdminController::class,'changePasswordPage'])->name('admin#changePasswordPage');
            Route::post('password/change',[AdminController::class,'changePassword'])->name('admin#changePassword');

            // profile
            Route::get('details',[AdminController::class,'details'])->name('admin#details');
            Route::get('edit',[AdminController::class,'edit'])->name('admin#edit');
            Route::post('update/{id}',[AdminController::class,'update'])->name('admin#update');

            // admin list
            Route::get('list',[AdminController::class,'list'])->name('admin#list');
            Route::get('delete/{id}',[AdminController::class,'delete'])->name('admin#delete');
            Route::get('changeRole/{id}',[AdminController::class,'changeRole'])->name('admin#changeRole');
            Route::post('change/role/{id}',[AdminController::class,'change'])->name('admin#role');
            Route::get('ajax/change/role',[AdminController::class,'adminChangeRole'])->name('ajax#changeRole');
            Route::get('userList',[UserController::class,'userList'])->name('user#list');
            Route::get('userDelete/{id}',[UserController::class,'deleteUser'])->name('user#delete');
            Route::get('userEdit/{id}',[UserController::class,'editUser'])->name('user#edit');
            Route::post('userUpdate/{id}',[UserController::class,'updateUser'])->name('user#update');
            Route::get('ajax/user/role/change',[UserController::class,'changeUserRole'])->name('user#roleChange');
        });

        // product
        Route::prefix('product')->group(function(){
            Route::get('list',[ProductController::class,'list'])->name('product#list');
            Route::get('create',[ProductController::class,'createPage'])->name('product#createPage');
            Route::post('create',[ProductController::class,'create'])->name('product#create');
            Route::get('delete/{id}',[ProductController::class,'delete'])->name('product#delete');
            Route::get('edit/{id}',[ProductController::class,'edit'])->name('product#edit');
            Route::get('update/{id}',[ProductController::class,'updatePage'])->name('product#updatePage');
            Route::post('update',[ProductController::class,'update'])->name('product#update');
        });

        // order
        Route::prefix('order')->group(function(){
            Route::get('list',[OrderController::class,'orderList'])->name('order#list');
            Route::get('change/status',[OrderController::class,'changeStatus'])->name('admin#changeStatus');
            Route::get('ajax/change/status',[OrderController::class,'ajaxChangeStatus'])->name('admin#ajaxChangeStatue');
        });

        // admin contact list
        Route::prefix('contact')->group(function(){
            Route::get('page',[ContactController::class,'AdminContactPage'])->name('admin#contact');
        });
    });

    // user
    Route::group(['prefix'=>'user','middleware'=>'user_auth'],function () {
        Route::get('homePage',[UserController::class,'home'])->name('user#home');
            Route::get('filter/{id}',[UserController::class,'filter'])->name('user#filter');
            Route::get('history',[UserController::class,'history'])->name('user#history');

            Route::prefix('password')->group(function(){
                Route::get('change',[UserController::class,'changePage'])->name('user#changePasswordPage');
                Route::post('change',[UserController::class,'changePassword'])->name('user#changePassword');
            });

            Route::prefix('pizza')->group(function(){
                Route::get('details/{id}',[UserController::class,'pizzaDetails'])->name('user#pizzaDetails');
            });

            //cart
            Route::prefix('cart')->group(function(){
                Route::get('list',[UserController::class,'cartList'])->name('user#cartList');
            });

            // profile
            Route::prefix('profile')->group(function(){
                Route::get('account',[UserController::class,'accountPage'])->name('user#accountPage');
                Route::post('account/{id}',[UserController::class,'accountChange'])->name('user#accountChange');
            });

            // contact
            Route::prefix('contactUs')->group(function(){
                Route::get('page',[ContactController::class,'userContactPage'])->name('user#contactPage');
                Route::post('information',[ContactController::class,'userContactInfo'])->name('user#contactInfo');
            });

            // ajax
            Route::prefix('ajax')->group(function(){
                Route::get('pizza/list',[AjaxController::class,'pizzaList'])->name('pizza#list');
                Route::get('addToCart',[AjaxController::class,'addToCart'])->name('ajax#cart');
                Route::get('order',[AjaxController::class,'order'])->name('ajax#order');
                Route::get('clear/cart',[AjaxController::class,'clearCart'])->name('ajax#clearCart');
                Route::get('clear/current/product',[AjaxController::class,'clearCurrentProduct'])->name('ajax#clearCurrentProduct');
                Route::get('increase/viewCount',[AjaxController::class,'increaseViewCount'])->name('ajax#increaseViewCount');
            });
        });
    });

