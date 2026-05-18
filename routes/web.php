<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\OfficerPageController;
use App\Http\Controllers\Web\UserPageController;
use App\Http\Controllers\BmkgController;
use App\Http\Controllers\Web\Officer\KelolaDataController;
use App\Http\Controllers\User\TindakanPreventifController;
use App\Http\Controllers\Web\Officer\HealthCenterController; 
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/bmkg-terbaru', [BmkgController::class, 'latest'])->name('user.bmkg.terbaru');

Route::prefix('user')->name('user.')->middleware('auth')->group(function () {
    Route::get('/home', [UserPageController::class, 'home'])->name('home');
    Route::get('/profil', [UserPageController::class, 'profile'])->name('profile');
    Route::get('/peta-evakuasi', [UserPageController::class, 'map'])->name('map');
    Route::get('/laporkan-bencana', [UserPageController::class, 'report'])->name('report');
    Route::get('/panduan-aman', [UserPageController::class, 'safety'])->name('safety');

    Route::resource('tindakan-preventif', TindakanPreventifController::class)
        ->parameters(['tindakan-preventif' => 'tindakanPreventif']);
});

Route::prefix('petugas')->middleware('auth')->group(function () {
    Route::get('/home', [OfficerPageController::class, 'home'])->name('officer.home');
    Route::get('/profil', [OfficerPageController::class, 'profile'])->name('officer.profile');
    Route::get('/kelola-data', [OfficerPageController::class, 'manageData'])->name('officer.manage-data');

    Route::prefix('kelola-data')->group(function () {
        Route::get('/laporan', [KelolaDataController::class, 'laporan'])->name('officer.kelola-data.laporan');
        Route::get('/evakuasi', [KelolaDataController::class, 'evakuasi'])->name('officer.kelola-data.evakuasi');
        Route::get('/shelter', [KelolaDataController::class, 'shelter'])->name('officer.kelola-data.shelter');
        
        Route::get('/faskes', [KelolaDataController::class, 'faskes'])->name('officer.kelola-data.faskes');
        Route::post('/health-centers/store', [HealthCenterController::class, 'store'])->name('officer.health-centers.store');
        
        Route::get('/penanggulangan', [KelolaDataController::class, 'penanggulangan'])->name('officer.kelola-data.penanggulangan');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';