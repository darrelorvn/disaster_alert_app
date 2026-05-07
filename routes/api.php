<?php

use App\Http\Controllers\Api\Integration\AiRecommendationController;
use App\Http\Controllers\Api\Integration\BmkgController;
use App\Http\Controllers\Api\Officer\DashboardController;
use App\Http\Controllers\Api\Officer\EmergencyPlaceManagementController;
use App\Http\Controllers\Api\Officer\EvacuationRouteManagementController;
use App\Http\Controllers\Api\Officer\HealthFacilityManagementController;
use App\Http\Controllers\Api\Officer\MitigationNoteController;
use App\Http\Controllers\Api\Officer\ProfileController as OfficerProfileController;
use App\Http\Controllers\Api\Officer\ReportManagementController;
use App\Http\Controllers\Api\User\DisasterReportController;
use App\Http\Controllers\Api\User\HomeController;
use App\Http\Controllers\Api\User\MapEvacuationController;
use App\Http\Controllers\Api\User\ProfileController as UserProfileController;
use App\Http\Controllers\Api\User\SafetyGuideController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function (): void {
    Route::prefix('user')->name('api.user.')->group(function (): void {
        Route::get('/home', [HomeController::class, 'index'])->name('home');
        Route::get('/home/active-disasters', [HomeController::class, 'activeDisasters'])->name('home.active-disasters');
        Route::get('/home/latest-reports', [HomeController::class, 'latestReports'])->name('home.latest-reports');
        Route::get('/home/quick-actions', [HomeController::class, 'nearbyQuickActions'])->name('home.quick-actions');

        Route::get('/peta-evakuasi', [MapEvacuationController::class, 'index'])->name('map.index');
        Route::get('/peta-evakuasi/jalur', [MapEvacuationController::class, 'routes'])->name('map.routes');
        Route::get('/peta-evakuasi/shelter-posko', [MapEvacuationController::class, 'shelters'])->name('map.shelters');
        Route::get('/peta-evakuasi/fasilitas-kesehatan', [MapEvacuationController::class, 'healthFacilities'])->name('map.health-facilities');
        Route::get('/peta-evakuasi/radius', [MapEvacuationController::class, 'radius'])->name('map.radius');

        Route::get('/laporan-bencana', [DisasterReportController::class, 'index'])->name('reports.index');
        Route::post('/laporan-bencana/preview', [DisasterReportController::class, 'preview'])->name('reports.preview');
        Route::post('/laporan-bencana', [DisasterReportController::class, 'store'])->name('reports.store');
        Route::get('/laporan-bencana/{report}', [DisasterReportController::class, 'show'])->name('reports.show');

        Route::get('/panduan-aman', [SafetyGuideController::class, 'index'])->name('safety.index');
        Route::get('/panduan-aman/berita', [SafetyGuideController::class, 'news'])->name('safety.news');
        Route::get('/panduan-aman/video', [SafetyGuideController::class, 'videos'])->name('safety.videos');
        Route::get('/panduan-aman/{guide}', [SafetyGuideController::class, 'show'])->name('safety.show');

        Route::get('/profil', [UserProfileController::class, 'show'])->name('profile.show');
        Route::put('/profil', [UserProfileController::class, 'update'])->name('profile.update');
        Route::get('/profil/riwayat-laporan', [UserProfileController::class, 'reportHistory'])->name('profile.report-history');
        Route::get('/profil/preferensi-notifikasi', [UserProfileController::class, 'notificationPreference'])->name('profile.notification-preference');
        Route::get('/profil/keamanan', [UserProfileController::class, 'security'])->name('profile.security');
    });

    Route::prefix('petugas')->name('api.officer.')->group(function (): void {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::get('/dashboard/statistik', [DashboardController::class, 'statistics'])->name('dashboard.statistics');
        Route::get('/dashboard/peta', [DashboardController::class, 'map'])->name('dashboard.map');
        Route::get('/dashboard/feed', [DashboardController::class, 'feed'])->name('dashboard.feed');

        Route::get('/laporan-bencana', [ReportManagementController::class, 'index'])->name('reports.index');
        Route::get('/laporan-bencana/{report}', [ReportManagementController::class, 'show'])->name('reports.show');
        Route::patch('/laporan-bencana/{report}/status', [ReportManagementController::class, 'updateStatus'])->name('reports.update-status');

        Route::apiResource('/jalur-evakuasi', EvacuationRouteManagementController::class)->parameters(['jalur-evakuasi' => 'route']);
        Route::apiResource('/shelter-posko', EmergencyPlaceManagementController::class)->parameters(['shelter-posko' => 'place']);
        Route::apiResource('/fasilitas-kesehatan', HealthFacilityManagementController::class)->parameters(['fasilitas-kesehatan' => 'facility']);
        Route::apiResource('/catatan-penanggulangan', MitigationNoteController::class)->parameters(['catatan-penanggulangan' => 'note']);

        Route::get('/profil', [OfficerProfileController::class, 'show'])->name('profile.show');
        Route::put('/profil', [OfficerProfileController::class, 'update'])->name('profile.update');
        Route::get('/profil/keamanan', [OfficerProfileController::class, 'security'])->name('profile.security');
        Route::get('/profil/notifikasi-internal', [OfficerProfileController::class, 'notification'])->name('profile.notification');
        Route::get('/profil/bantuan', [OfficerProfileController::class, 'support'])->name('profile.support');
    });

    Route::prefix('integrations')->name('api.integrations.')->group(function (): void {
        Route::get('/bmkg/status', [BmkgController::class, 'status'])->name('bmkg.status');
        Route::get('/bmkg/latest', [BmkgController::class, 'latest'])->name('bmkg.latest');
        Route::post('/bmkg/sync', [BmkgController::class, 'sync'])->name('bmkg.sync');

        Route::post('/ai/recommendation/responsive', [AiRecommendationController::class, 'responsive'])->name('ai.responsive');
        Route::post('/ai/recommendation/preventive', [AiRecommendationController::class, 'preventive'])->name('ai.preventive');
    });
});
