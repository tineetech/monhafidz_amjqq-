<?php

use App\Http\Controllers\LaporanController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\SertifikatController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/wablast', [NotifikasiController::class, 'wablast'])->name('wablast');

// route chart 
Route::get('/laporan/chart-ziyadah', [LaporanController::class, 'chartZiyadah']);

// route get laporan 
Route::post('/laporan/hafalan', [LaporanController::class, 'getLaporanHafalan']);
Route::post('/laporan/absensi', [LaporanController::class, 'laporanAbsensi']);
