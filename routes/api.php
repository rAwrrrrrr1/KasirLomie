<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\TransactionController;

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

// Route untuk mengambil data user (jika menggunakan Sanctum auth)
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// ✅ Route API untuk program kasir
Route::get('/menus', [MenuController::class, 'index']); // GET daftar menu
Route::post('/transactions', [TransactionController::class, 'store']); // POST transaksi baru
Route::get('/transactions', [TransactionController::class, 'index']); // GET semua transaksi
