<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



//Product
Route::get('/product/all',[ProductController::class,'getAll']);
Route::get('/product/get/{id}',[ProductController::class,'get']);
Route::post('/product/add',[ProductController::class,'addProduct']);
Route::put('/product/update/{id}',[ProductController::class,'updateProduct']);
Route::post('/product/delete/{id}',[ProductController::class,'deleteProduct']);



//Category
Route::get('/category/all',[CategoryController::class,'getAll']);
Route::post('/category/add',[CategoryController::class,'addCategory']);
Route::put('/category/update/{id}',[CategoryController::class,'updateCategory']);
Route::post('/category/delete/{id}',[CategoryController::class,'deleteCategory']);
Route::get('/category/details/{id}',[CategoryController::class,'detailsCategory']);





//Employee
Route::get('/employee/all',[EmployeeController::class,'getAll']);
Route::get('/employee/get/{id}',[EmployeeController::class,'get']);
Route::post('/employee/add',[EmployeeController::class,'addEmployee']);
Route::put('/employee/update/{id}',[EmployeeController::class,'updateEmployee']);
Route::post('/employee/delete/{id}',[EmployeeController::class,'deleteEmployee']);


//Order

Route::get('/order/all',[OrderController::class,'getAll']);
Route::get('/order/get/{id}',[OrderController::class,'get']);
Route::post('/order/delete/{id}',[OrderController::class,'deleteOrder']);





//Customer
Route::get('/customer/all',[CustomerController::class,'getAll']);
Route::get('/customer/get/{id}',[CustomerController::class,'get']);
Route::post('/registration/',[CustomerController::class,'Registration']);
Route::post('/customer/delete/{id}',[CustomerController::class,'deleteCustomer']);




//Manager
Route::get('/manager/get/{id}',[ManagerController::class,'get']);
Route::put('/manager/update/{id}',[ManagerController::class,'updateManager']);




