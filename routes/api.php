<?php

use App\Http\Controllers\Api\BukuController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Contoh rute yang dapat diakses via API
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route untuk mendapatkan semua buku
Route::get('buku', [BukuController::class, 'index']);

// Route untuk menyimpan buku baru (POST)
Route::post('buku', [BukuController::class, 'store']);

// Route untuk mendapatkan satu buku berdasarkan ID (GET)
Route::get('buku/{id}', [BukuController::class, 'show']);

// Route untuk mengupdate buku berdasarkan ID (PUT)
Route::put('buku/{id}', [BukuController::class, 'update']);

// Route untuk menghapus buku berdasarkan ID (DELETE)
Route::delete('buku/{id}', [BukuController::class, 'destroy']);