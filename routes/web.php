<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\ExpedisiController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/login',[AuthController::class,'login'])->name('login');
Route::post('/login',[AuthController::class,'loginProses']);
Route::get('/logout',[AuthController::class,'logout']);

Route::group(['prefix' => '/','middleware'=>'auth'], function() {
	Route::get('/',[DashboardController::class,'index']);
	Route::get('/dashboard',[DashboardController::class,'index']);

	Route::get('/cart',[CartController::class,'index']);

	Route::get('/product',[ProductController::class,'index']);
	Route::POST('/product/delete',[ProductController::class,'delete']);
	Route::get('/product/add',[ProductController::class,'add']);
	Route::post('/product/add',[ProductController::class,'add_proses']);
	Route::get('/product/edit/{id}',[ProductController::class,'edit']);
	Route::post('/product/edit/{id}',[ProductController::class,'edit_proses']);
	Route::get('/product/sold',[ProductController::class,'sold']);
	Route::get('/product/sold_po',[ProductController::class,'sold_po']);

	Route::get('/footer',[WebController::class,'footer']);
	Route::post('/footer',[WebController::class,'footer_edit']);

	Route::get('/slider',[WebController::class,'slider']);
	Route::post('/slider/delete',[WebController::class,'slider_delete']);
	Route::post('/slider/add',[WebController::class,'add_slider']);
	Route::post('/slider/edit',[WebController::class,'edit_slider']);

	Route::get('/expedisi',[ExpedisiController::class,'index']);
	Route::post('/expedisi',[ExpedisiController::class,'update']);

	Route::get('/member',[MemberController::class,'index']);
	Route::get('/member/add',[MemberController::class,'add']);
	Route::post('/member/add',[MemberController::class,'add_proses']);
	Route::get('/member/edit/{id}',[MemberController::class,'edit']);
	Route::post('/member/edit/{id}',[MemberController::class,'edit_proses']);
	Route::post('/member/delete',[MemberController::class,'delete']);
	Route::get('/member/history/{id}',[MemberController::class,'history']);
	Route::post('/member/history/{id}',[MemberController::class,'filter']);

	Route::get('/order/ready_stock',[OrderController::class,'ready_stock']);
	Route::post('/order/ready_stock',[OrderController::class,'filter_rs']);
	Route::get('/order/ready_stock/{id}',[OrderController::class,'detail_rs']);

	Route::post('/order/change_status',[OrderController::class,'change_status']);
	Route::post('/order/change_resi',[OrderController::class,'change_resi']);
	Route::get('/order/invoice/{id}',[OrderController::class,'invoice']);

	Route::get('/order/po',[OrderController::class,'po']);
	Route::post('/order/po',[OrderController::class,'filter_po']);
	Route::get('/order/po/{id}',[OrderController::class,'detail_po']);
	Route::post('/order/po/update_qty/{id}',[OrderController::class,'update_qty']);
	Route::post('/order/po/update_catatan/{id}',[OrderController::class,'update_catatan']);
	Route::get('/order/po/add/{id}',[OrderController::class,'add']);
	Route::post('/order/po/add/{id}',[OrderController::class,'add_order']);
	Route::post('/order/po/delete',[OrderController::class,'delete']);
	Route::get('/order/po/add/detail/{id}',[OrderController::class,'add_detail']);
});
