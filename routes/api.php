<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RouteController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// GET
Route::get('product/lists',[RouteController::class,'productList']);
Route::get('category/lists',[RouteController::class,'categoryList']);
Route::get('user/lists',[RouteController::class,'userList']);
Route::get('order/lists',[RouteController::class,'orderList']);

// POST
Route::post('create/category',[RouteController::class,'createCategory']);
Route::post('create/contact',[RouteController::class,'createContact']);    // CREATE
Route::post('delete/category',[RouteController::class,'deleteCategory']);  // DELETE
Route::get('category/detail/{id}',[RouteController::class,'categoryDetail']); // READ
Route::post('category/update',[RouteController::class,'updateCategory']);  // UPDATE


/**
 *  get product lists
 *  http://localhost:8000/api/product/lists (GET)
 *
 *
 *  get category lists
 *  http://localhost:8000/api/category/lists (GET)
 *
 *  get user lists
 *  http://localhost:8000/api/user/lists (GET)
 *
 *  create category
 *  http://localhost:8000/api/create/category (POST)
 *  body{
 *      name : ''
 *  }
 *
 *  create contact
 *  http://localhost:8000/api/create/contact (POST)
 *  body{
 *      name : ' ' ,
 *      email : ' ' ,
 *      message : ' '
 *  }
 *
 *  delete data
 *  http://localhost:8000/api/delete/category (POST)
 *
 *  update
 *  http://localhost:8000/api/category/update (POST)
 *
 *  key==> category_name , category_id
 *
 */


 
