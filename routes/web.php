<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\OfficerPageController;
use App\Http\Controllers\Web\UserPageController;
use App\Http\Controllers\BmkgController;
use App\Http\Controllers\Web\Officer\KelolaDataController;
use App\Http\Controllers\User\TindakanPreventifController;
use App\Http\Controllers\User\DisasterReportController;
use App\Http\Controllers\Api\Officer\EmergencyPlaceManagementController;
use App\Http\Controllers\Api\Officer\HealthFacilityManagementController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/bmkg-terbaru', [BmkgController::class, 'latest'])->name('user.bmkg.terbaru');

Route::prefix('user')->name('user.')->middleware('auth')->group(function () {
    Route::get('/home', [UserPageController::class, 'home'])->name('home');
    Route::get('/profil', [UserPageController::class, 'profile'])->name('profile');
    Route::get('/peta-evakuasi', function() { return redirect()->route('user.map.laporan'); })->name('map');
    Route::get('/peta-evakuasi/laporan', [UserPageController::class, 'mapLaporan'])->name('map.laporan');
    Route::get('/peta-evakuasi/shelter-posko', [UserPageController::class, 'mapShelter'])->name('map.shelter');
    Route::get('/peta-evakuasi/fasilitas-kesehatan', [UserPageController::class, 'mapFaskes'])->name('map.faskes');
    Route::get('/panduan-aman', [UserPageController::class, 'safety'])->name('safety');

    Route::get('/laporan-bencana', [DisasterReportController::class, 'index'])->name('laporan-bencana.index');
    Route::get('/laporkan-bencana', [DisasterReportController::class, 'create'])->name('report');
    Route::post('/laporkan-bencana', [DisasterReportController::class, 'store'])->name('laporan-bencana.store');
    Route::get('/laporan-bencana/{report}', [DisasterReportController::class, 'show'])->name('laporan-bencana.show');

    Route::resource('tindakan-preventif', TindakanPreventifController::class)
        ->parameters(['tindakan-preventif' => 'tindakanPreventif']);
});

Route::prefix('petugas')->name('officer.')->middleware('auth')->group(function () {
    Route::get('/home', [OfficerPageController::class, 'home'])->name('home');
    Route::get('/profil', [OfficerPageController::class, 'profile'])->name('profile');
    
    Route::get('/kelola-data', [OfficerPageController::class, 'manageData'])->name('manage-data');

    Route::prefix('kelola-data')->name('kelola-data.')->group(function () {
        
        Route::resource('shelter', EmergencyPlaceManagementController::class)
            ->parameters(['shelter' => 'place']);
            
        Route::resource('faskes', HealthFacilityManagementController::class)
            ->parameters(['faskes' => 'facility']);
        
        Route::get('/evakuasi', [KelolaDataController::class, 'evakuasi'])->name('evakuasi');
        
        Route::get('/penanggulangan', [KelolaDataController::class, 'penanggulangan'])->name('penanggulangan');
        
        Route::get('/laporan', [KelolaDataController::class, 'laporan'])->name('laporan');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';