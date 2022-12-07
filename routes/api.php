<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\WishlistController;

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

//authentication only endpoint
Route::post('/register', [AdminController::class, 'register']);
Route::post('/login', [AdminController::class, 'login']);

//global endpoint
Route::get('/produk', [ProdukController::class, 'index']);
Route::get('/produk/{id}', [ProdukController::class, 'show']);

//protected and admin only endpoint
Route::middleware('auth:sanctum')->group(function (){
    Route::post('/logout', [AdminController::class, 'logout']);
    Route::post('/payments', [PaymentController::class, 'postPayments']);
    Route::post('/payments/{id}', [PaymentController::class, 'deletePayments']);
    Route::get('/payments', [PaymentController::class, 'getPayments']);
    Route::get('/payments/{id}', [PaymentController::class, 'showPayments']);
    route::get('/wishlist', [WishlistController::class, 'index']);
    route::get('/wishlist/{id}', [WishlistController::class, 'show']);
    route::post('/wishlist', [WishlistController::class, 'store']);
    route::post('/edit-wishlist/{id}', [WishlistController::class, 'update']);
    route::post('/wishlist/{id}', [WishlistController::class, 'destroy']);
    Route::middleware('handle')->group(function(){
        route::post('/tambah-produk', [ProdukController::class, 'store']);
        route::post('/edit-produk/{id}', [ProdukController::class, 'update']);
        route::post('/hapus-produk/{id}', [ProdukController::class, 'destroy']);
    });
});

//Admin Route