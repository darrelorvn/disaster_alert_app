<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvacuationRoute extends Model
{

    protected $fillable = ['name','disaster_type','status','area','start_latitude','start_longitude','end_latitude','end_longitude','distance_km','description'];

protected $casts = [
    'metadata' => 'array',
    'occurred_at' => 'datetime',
    'resolved_at' => 'datetime',
    'verified_at' => 'datetime',
    'action_date' => 'date',
    'is_published' => 'boolean',
];

}
