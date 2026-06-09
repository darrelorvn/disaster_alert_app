<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DisasterEvent extends Model
{
    protected $fillable = [
        'type',
        'status',
        'source',
        'title',
        'summary',
        'location_name',
        'latitude',
        'longitude',
        'occurred_at',
        'resolved_at',
        'expired_at',
        'metadata',
    ];

    protected $casts = [
        'metadata' => 'array',
        'occurred_at' => 'datetime',
        'resolved_at' => 'datetime',
        'expired_at' => 'datetime',
        'latitude' => 'float',
        'longitude' => 'float',
    ];

    public function reports(): HasMany
    {
        return $this->hasMany(DisasterReport::class);
    }
}
