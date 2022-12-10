<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PemasukanProductController;
use App\Http\Controllers\PengeluaranProductController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PemasukanRawController;
use App\Http\Controllers\PengeluaranRawController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\RawController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/untuk-produksi', [RawController::class, 'index']);
Route::post('/untuk-produksi-create', [RawController::class, 'store']);
Route::delete('/untuk-produksi-delete/{id}', [RawController::class, 'destroy']);
Route::post('/untuk-produksi-edit/{id}', [RawController::class, 'update']);

Route::get('/hasil-produksi', [ProductController::class, 'index']);
Route::post('/hasil-produksi-create', [ProductController::class, 'store']);
Route::delete('/hasil-produksi-delete/{id}', [ProductController::class, 'destroy']);
Route::post('/hasil-produksi-edit/{id}', [ProductController::class, 'update']);

Route::get('/category', [CategoryController::class, 'index']);
Route::post('/category-create', [CategoryController::class, 'store']);
Route::delete('/category-delete/{id}', [CategoryController::class, 'destroy']);

Route::get('/masuk-raw', [PemasukanRawController::class, 'index']);
Route::post('/masuk-raw-create', [PemasukanRawController::class, 'store']);
Route::delete('/masuk-raw-delete/{id}', [PemasukanRawController::class, 'destroy']);

Route::get('/keluar-raw', [PengeluaranRawController::class, 'index']);
Route::post('/keluar-raw-create', [PengeluaranRawController::class, 'store']);
Route::delete('/keluar-raw-delete/{id}', [PengeluaranRawController::class, 'destroy']);

Route::get('/masuk-product', [PemasukanProductController::class, 'index']);
Route::post('/masuk-product-create', [PemasukanProductController::class, 'store']);
Route::delete('/masuk-product-delete/{id}', [PemasukanProductController::class, 'destroy']);

Route::get('/keluar-product', [PengeluaranProductController::class, 'index']);
Route::post('/keluar-product-create', [PengeluaranProductController::class, 'store']);
Route::delete('/keluar-product-delete/{id}', [PengeluaranProductController::class, 'destroy']);

Route::get('/history', [HistoryController::class, 'index']);
Route::post('/history-create', [HistoryController::class, 'store']);
Route::delete('/history-delete/{id}', [HistoryController::class, 'destroy']);
