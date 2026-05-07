<?php

namespace App\Providers;

use App\Repositories\Contracts\DisasterReportRepositoryInterface;
use App\Repositories\Contracts\EvacuationRouteRepositoryInterface;
use App\Repositories\Contracts\EmergencyPlaceRepositoryInterface;
use App\Repositories\Eloquent\DisasterReportRepository;
use App\Repositories\Eloquent\EmergencyPlaceRepository;
use App\Repositories\Eloquent\EvacuationRouteRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(DisasterReportRepositoryInterface::class, DisasterReportRepository::class);
        $this->app->bind(EvacuationRouteRepositoryInterface::class, EvacuationRouteRepository::class);
        $this->app->bind(EmergencyPlaceRepositoryInterface::class, EmergencyPlaceRepository::class);
    }

    public function boot(): void
    {
        // TODO: register model policies, observers, and global configuration.
    }
}
