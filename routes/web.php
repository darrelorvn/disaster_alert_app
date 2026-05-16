<?php

use App\Http\Controllers\Web\OfficerPageController;
use App\Http\Controllers\Web\UserPageController;
use App\Models\SafetyGuide; 
use Illuminate\Support\Facades\Route;


Route::get('/', [UserPageController::class, 'home'])->name('user.home');

Route::prefix('user')->name('user.')->group(function (): void {
    Route::get('/home', [UserPageController::class, 'home'])->name('home');
    Route::get('/peta-evakuasi', [UserPageController::class, 'map'])->name('map');
    Route::get('/laporkan-bencana', [UserPageController::class, 'report'])->name('report');
    Route::get('/panduan-aman', [UserPageController::class, 'safety'])->name('safety');
    Route::get('/profil', [UserPageController::class, 'profile'])->name('profile');
});

Route::prefix('petugas')->name('officer.')->group(function (): void {
    Route::get('/home', [OfficerPageController::class, 'home'])->name('home');
    Route::get('/kelola-data', [OfficerPageController::class, 'manageData'])->name('manage-data');
    Route::get('/profil', [OfficerPageController::class, 'profile'])->name('profile');
});

use App\Http\Controllers\Web\Officer\KelolaDataController;

// ... route lainnya ...

// Pastikan ini nantinya dibungkus dengan middleware auth & role:officer
Route::prefix('petugas/kelola-data')->name('officer.kelola-data.')->group(function () {
    Route::get('/laporan', [KelolaDataController::class, 'laporan'])->name('laporan');
    Route::get('/evakuasi', [KelolaDataController::class, 'evakuasi'])->name('evakuasi');
    Route::get('/shelter', [KelolaDataController::class, 'shelter'])->name('shelter');
    Route::get('/faskes', [KelolaDataController::class, 'faskes'])->name('faskes');
    Route::get('/penanggulangan', [KelolaDataController::class, 'penanggulangan'])->name('penanggulangan');
});