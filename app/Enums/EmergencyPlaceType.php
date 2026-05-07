<?php

namespace App\Enums;

enum EmergencyPlaceType: string
{
    case Shelter = 'shelter';
case EmergencyPost = 'emergency_post';
case HealthPost = 'health_post';
case HealthFacility = 'health_facility';
}
