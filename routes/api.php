<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{TransactionController, MahasiswaController, ProdiController};

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('transaction', [TransactionController::class, 'index'])->name('transaction');
Route::get('transaction/{transaction}', [TransactionController::class, 'show']);
Route::post('transaction', [TransactionController::class, 'store']);
Route::put('transaction/{transaction}', [TransactionController::class, 'update']);
Route::delete('transaction/{transaction}', [TransactionController::class, 'destroy']);

Route::get('mahasiswa', [MahasiswaController::class, 'index']);
Route::post('mahasiswa', [MahasiswaController::class, 'store']);
Route::put('mahasiswa/{mahasiswa}', [MahasiswaController::class, 'update']);
Route::get('mahasiswa/{mahasiswa}', [MahasiswaController::class, 'show']);
Route::delete('mahasiswa/{mahasiswa}', [MahasiswaController::class, 'destroy']);

Route::get('prodi', [ProdiController::class, 'index']);
Route::post('prodi', [ProdiController::class, 'store']);
Route::put('prodi/{prodi}', [ProdiController::class, 'update']);
Route::get('prodi/{prodi}', [ProdiController::class, 'show']);
Route::delete('prodi/{prodi}', [ProdiController::class, 'destroy']);
