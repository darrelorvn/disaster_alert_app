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
use App\Http\Controllers\Api\Officer\EvacuationRouteManagementController;
use App\Http\Controllers\MitigationNoteController;
use App\Http\Controllers\Web\Officer\DisasterReportManagementController;
use App\Http\Controllers\AiRecomendationController;
use App\Http\Controllers\AiRecomendationOfficerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return auth()->user()->isOfficer() 
            ? redirect()->route('officer.home') 
            : redirect()->route('user.home');
    }
    
    return redirect()->route('login');
});

Route::get('/bmkg-terbaru', [BmkgController::class, 'latest'])->name('user.bmkg.terbaru');

/*
|--------------------------------------------------------------------------
| Rute Masyarakat (User)
|--------------------------------------------------------------------------
*/
Route::prefix('user')->name('user.')->middleware('auth')->group(function () {
    Route::get('/home', [UserPageController::class, 'home'])->name('home');
    Route::get('/profil', [UserPageController::class, 'profile'])->name('profile');
    Route::get('/peta-evakuasi', function () { return redirect()->route('user.map.laporan'); })->name('map');
    Route::get('/peta-evakuasi/laporan', [UserPageController::class, 'mapLaporan'])->name('map.laporan');
    Route::get('/peta-evakuasi/evakuasi', [UserPageController::class, 'mapEvakuasi'])->name('map.evakuasi');
    Route::get('/peta-evakuasi/shelter-posko', [UserPageController::class, 'mapShelter'])->name('map.shelter');
    Route::get('/peta-evakuasi/fasilitas-kesehatan', [UserPageController::class, 'mapFaskes'])->name('map.faskes');
    Route::get('/panduan-aman', [UserPageController::class, 'safety'])->name('safety');

    Route::get('/laporan-bencana', [DisasterReportController::class, 'index'])->name('laporan-bencana.index');
    Route::get('/laporkan-bencana', [DisasterReportController::class, 'create'])->name('report');
    Route::post('/laporkan-bencana', [DisasterReportController::class, 'store'])->name('laporan-bencana.store');
    Route::get('/laporan-bencana/{report}', [DisasterReportController::class, 'show'])->name('laporan-bencana.show');

    Route::resource('tindakan-preventif', TindakanPreventifController::class)
        ->parameters(['tindakan-preventif' => 'tindakanPreventif']);

    Route::get('/rekomendasi-ai', [AiRecomendationController::class, 'index'])->name('ai-recommendation.index');
    Route::post('/rekomendasi-ai/perbarui', [UserPageController::class, 'refreshAi'])->name('ai-recommendation.refresh');
});

/*
|--------------------------------------------------------------------------
| Rute Petugas (Officer)
|--------------------------------------------------------------------------
*/
Route::prefix('petugas')->name('officer.')->middleware('auth')->group(function () {
    Route::get('/home', [OfficerPageController::class, 'home'])->name('home');
    Route::get('/profil', [OfficerPageController::class, 'profile'])->name('profile');

    Route::get('/kelola-data', [OfficerPageController::class, 'manageData'])->name('manage-data');

    Route::prefix('kelola-data')->name('kelola-data.')->group(function () {

        // Shelter & Posko
        Route::resource('shelter', EmergencyPlaceManagementController::class)
            ->parameters(['shelter' => 'place']);

        // Fasilitas Kesehatan
        Route::resource('faskes', HealthFacilityManagementController::class)
            ->parameters(['faskes' => 'facility']);

        Route::resource('evakuasi', EvacuationRouteManagementController::class)
            ->parameters(['evakuasi' => 'route']);

        Route::resource('penanggulangan', MitigationNoteController::class)
        ->parameters(['penanggulangan' => 'penanggulangan']);

        Route::resource('laporan-bencana', DisasterReportManagementController::class)
            ->parameters(['laporan-bencana' => 'report'])
            ->names([
                'index'   => 'laporan',
                'create'  => 'laporan.create',
                'store'   => 'laporan.store',
                'show'    => 'laporan.show',
                'edit'    => 'laporan.edit',
                'update'  => 'laporan.update',
                'destroy' => 'laporan.destroy',
            ]);
    });

    Route::get('/rekomendasi-ai', [AiRecomendationOfficerController::class, 'index'])->name('ai-recommendation.index');
    Route::post('/rekomendasi-ai/perbarui', [OfficerPageController::class, 'refreshAi'])->name('ai-recommendation.refresh');
});

/*
|--------------------------------------------------------------------------
| Rute Bawaan Laravel Breeze (Profile & Auth)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';