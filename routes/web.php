<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\OfficerPageController;
use App\Http\Controllers\Web\UserPageController;
use App\Http\Controllers\BmkgController;
use App\Http\Controllers\Web\Officer\KelolaDataController;
use App\Http\Controllers\User\TindakanPreventifController;
use App\Http\Controllers\User\DisasterReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/bmkg-terbaru', [BmkgController::class, 'latest'])->name('user.bmkg.terbaru');

Route::prefix('user')->name('user.')->middleware('auth')->group(function () {
    Route::get('/home', [UserPageController::class, 'home'])->name('home');
    Route::get('/profil', [UserPageController::class, 'profile'])->name('profile');
    Route::get('/peta-evakuasi', [UserPageController::class, 'map'])->name('map');
    Route::get('/panduan-aman', [UserPageController::class, 'safety'])->name('safety');

    Route::get('/laporan-bencana', [DisasterReportController::class, 'index'])->name('laporan-bencana.index');
    Route::get('/laporkan-bencana', [DisasterReportController::class, 'create'])->name('report');
    Route::post('/laporkan-bencana', [DisasterReportController::class, 'store'])->name('laporan-bencana.store');
    Route::get('/laporan-bencana/{report}', [DisasterReportController::class, 'show'])->name('laporan-bencana.show');

    // Tindakan Preventif
    Route::resource('tindakan-preventif', TindakanPreventifController::class)
        ->parameters(['tindakan-preventif' => 'tindakanPreventif']);
});

Route::prefix('petugas')->name('officer.')->middleware('auth')->group(function () {
    Route::get('/home', [OfficerPageController::class, 'home'])->name('home');
    Route::get('/profil', [OfficerPageController::class, 'profile'])->name('profile');
    Route::get('/kelola-data', [OfficerPageController::class, 'manageData'])->name('manage-data');

    Route::prefix('kelola-data')->name('kelola-data.')->group(function () {
        Route::get('/laporan', [KelolaDataController::class, 'laporan'])->name('laporan');
        Route::get('/evakuasi', [KelolaDataController::class, 'evakuasi'])->name('evakuasi');
        Route::get('/shelter', [KelolaDataController::class, 'shelter'])->name('shelter');
        Route::get('/faskes', [KelolaDataController::class, 'faskes'])->name('faskes');
        Route::get('/penanggulangan', [KelolaDataController::class, 'penanggulangan'])->name('penanggulangan');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';