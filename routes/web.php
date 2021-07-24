<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
Auth::routes(['register'=>false]);
Route::get('/',[HomeController::class,'index']);
Route::resource('category', CategoryController::class);
Route::resource('product', ProductController::class)->middleware('auth');
Route::get('edit/{id}',[ProductController::class,'edit'])->name('product.edit');
Route::get('editcat/{id}',[CategoryController::class,'edit'])->name('category.edit');
Route::get('delete/{id}',[ProductController::class,'destroy'])->name('product.delete');
Route::get('deletecat/{id}',[CategoryController::class,'destroy'])->name('category.delete');
Route::post('update',[ProductController::class,'update'])->name('product.update');
Route::post('updatecat',[CategoryController::class,'update'])->name('category.update');
Route::get('/{page}', [AdminController::class,'index']);


