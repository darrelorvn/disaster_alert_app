<?php

namespace App\Enums;

enum DisasterType: string
{
    case Flood = 'flood';
case Earthquake = 'earthquake';
case Landslide = 'landslide';
case Fire = 'fire';
case Tsunami = 'tsunami';
case Volcano = 'volcano';
case Other = 'other';
}
