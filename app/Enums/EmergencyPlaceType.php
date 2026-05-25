<?php

namespace App\Enums;

enum EmergencyPlaceType: string
{
    case Shelter = 'shelter';
    case EmergencyPost = 'emergency_post';
    case HealthPost = 'health_post';
    case HealthFacility = 'health_facility';

    public function label(): string
    {
        return match($this) {
            self::Shelter => 'Shelter Evakuasi',
            self::EmergencyPost => 'Posko Darurat',
            self::HealthPost => 'Pos Kesehatan',
            self::HealthFacility => 'Fasilitas Kesehatan',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::Shelter => 'bg-green-50 text-green-600',
            self::EmergencyPost => 'bg-orange-50 text-orange-600',
            self::HealthPost => 'bg-blue-50 text-blue-600',
            self::HealthFacility => 'bg-indigo-50 text-indigo-600',
        };
    }
}