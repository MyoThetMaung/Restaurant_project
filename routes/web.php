<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DishController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\CategoryController;

Auth::routes();

//Waiter Panel
Route::get('/',[OrderController::class,'index'])->name('order.form');
Route::post('orderSubmit',[OrderController::class,'orderSubmit'])->name('order.submit');

//Kitchen Panel
Route::resource('dish', DishController::class);
Route::resource('category', CategoryController::class);
Route::resource('table', TableController::class);

Route::get('order',[DishController::class,'order'])->name('order');
Route::get('order/approve/{order}',[DishController::class,'orderApprove'])->name('order.approve');
Route::get('order/cancel/{order}',[DishController::class,'orderCancel'])->name('order.cancel');
Route::get('order/ready/{order}',[DishController::class,'orderReady'])->name('order.ready');
Route::get('order/serve/{order}',[DishController::class,'orderServe'])->name('order.serve');
