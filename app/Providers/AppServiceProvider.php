<?php

namespace App\Providers;

use App\Repositories\Contracts\DisasterEventRepositoryInterface;
use App\Repositories\Contracts\DisasterReportRepositoryInterface;
use App\Repositories\Contracts\EmergencyPlaceRepositoryInterface;
use App\Repositories\Contracts\EvacuationRouteRepositoryInterface;
use App\Repositories\Contracts\MitigationNoteRepositoryInterface;
use App\Repositories\Contracts\SafetyGuideRepositoryInterface;
use App\Repositories\Eloquent\DisasterEventRepository;
use App\Repositories\Eloquent\DisasterReportRepository;
use App\Repositories\Eloquent\EmergencyPlaceRepository;
use App\Repositories\Eloquent\EvacuationRouteRepository;
use App\Repositories\Eloquent\MitigationNoteRepository;
use App\Repositories\Eloquent\SafetyGuideRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(DisasterEventRepositoryInterface::class, DisasterEventRepository::class);
        $this->app->bind(DisasterReportRepositoryInterface::class, DisasterReportRepository::class);
        $this->app->bind(EvacuationRouteRepositoryInterface::class, EvacuationRouteRepository::class);
        $this->app->bind(EmergencyPlaceRepositoryInterface::class, EmergencyPlaceRepository::class);
        $this->app->bind(MitigationNoteRepositoryInterface::class, MitigationNoteRepository::class);
        $this->app->bind(SafetyGuideRepositoryInterface::class, SafetyGuideRepository::class);
    }

    public function boot(): void
    {
    }
}
