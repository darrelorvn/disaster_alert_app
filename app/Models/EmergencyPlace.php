<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\EmergencyPlaceType; // <-- PASTIKAN IMPORT INI ADA

class EmergencyPlace extends Model
{
    protected $fillable = [
        'name',
        'type',
        'address',
        'area',
        'latitude',
        'longitude',
        'capacity',
        'contact',
        'status',
        'metadata',
    ];

    protected $casts = [
        'type' => EmergencyPlaceType::class, // <-- TAMBAHKAN BARIS INI
        'metadata' => 'array',
        'latitude' => 'float',
        'longitude' => 'float',
        'capacity' => 'integer',
    ];
}