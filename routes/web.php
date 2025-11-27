<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\SertifikatController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', [BerandaController::class, 'index'])->name('beranda');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('/master')->group(function () {
        Route::resource('/santri', App\Http\Controllers\SantriController::class);
        Route::resource('/ustadzah', App\Http\Controllers\UstadController::class);
        Route::resource('/wali', App\Http\Controllers\WaliController::class);
        Route::resource('/semester', App\Http\Controllers\SemesterController::class);
    });

    Route::resource('/jadwal-hafalan', App\Http\Controllers\JadwalHafalanController::class);
    Route::get('/jadwal-hafalan-zm/edit', [App\Http\Controllers\JadwalHafalanController::class, 'editAddon'])->name('jadwal-hafalan.edit');
    Route::put('/jadwal-hafalan-zm/update', [App\Http\Controllers\JadwalHafalanController::class, 'update'])->name('jadwal-hafalan-zm.update');

    Route::resource('/absensi', App\Http\Controllers\AbsensiController::class);
    Route::get('/absensi-santri/pengajuan-izin', [App\Http\Controllers\AbsensiController::class, 'pengajuanIzin'])->name('absensi.izin');
    Route::post('/absensi-santri/pengajuan-izin', [App\Http\Controllers\AbsensiController::class, 'pengajuanIzinPost'])->name('perizinan.store');
    Route::post('/absensi-santri/pengajuan-izin/delete/{id}', [App\Http\Controllers\AbsensiController::class, 'pengajuanIzinDelete'])->name('perizinan.destroy');
    Route::get('/absensi-santri/pengajuan-izin/setujui/{id}', [App\Http\Controllers\AbsensiController::class, 'pengajuanIzinSetujui'])->name('perizinan.setujui');
    Route::get('/get-hafalan/{santri_id}', [App\Http\Controllers\AbsensiController::class, 'getHafalan']);

    Route::resource('/pencatatan-hafalan', App\Http\Controllers\PencatatanHafalanController::class);
    Route::resource('/rekap-hafalan', App\Http\Controllers\RekapHafalanController::class);

    Route::resource('/jadwal-ujian', App\Http\Controllers\JadwalUjianController::class);
    Route::resource('/jadwal-ujian-tasmi', App\Http\Controllers\JadwalUjianTasmiController::class);
    Route::resource('/pencatatan-ujian', App\Http\Controllers\PencatatanUjianController::class);
    Route::resource('/ujian-tasmi', App\Http\Controllers\UjianTasmiController::class);
    Route::get('pencatatan-ujian/filter', [App\Http\Controllers\PencatatanUjianController::class, 'index'])->name('pencatatan-ujian.filter');
    
    Route::resource('/laporan', App\Http\Controllers\LaporanController::class);

    Route::resource('/manage-akun', App\Http\Controllers\ManajemenAkunController::class);
    Route::resource('/pengaturan', App\Http\Controllers\PengaturanController::class);
    
    
});

// route export
Route::get('/export/laporan/hafalan/export-pdf', [LaporanController::class, 'exportPdf']);
Route::get('/export/laporan/absensi/export-pdf', [LaporanController::class, 'exportPdfAbsensi']);


Route::get('/sertifikat-tahfidz', [SertifikatController::class, 'generate30Juz'])
    ->name('sertifikat.tahfidz');
Route::get('/sertifikat-kelulusan', [SertifikatController::class, 'generateSertifikatKelulusan'])
    ->name('sertifikat.kelulusan');
Route::get('/sertifikat-top3', [SertifikatController::class, 'generateSertifikatPeringkat'])
    ->name('sertifikat.top3');


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');