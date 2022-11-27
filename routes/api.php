<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProdukController;

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
    Route::middleware('handle')->group(function(){
        route::post('/tambah-produk', [ProdukController::class, 'store']);
        route::post('/edit-produk/{id}', [ProdukController::class, 'update']);
        route::post('/hapus-produk/{id}', [ProdukController::class, 'destroy']);

    });
});

//Admin Route