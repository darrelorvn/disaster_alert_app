<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmergencyPlace extends Model
{


    protected $fillable = ['name','type','address','area','latitude','longitude','capacity','contact','status','metadata'];

protected $casts = [
    'metadata' => 'array',
    'occurred_at' => 'datetime',
    'resolved_at' => 'datetime',
    'verified_at' => 'datetime',
    'action_date' => 'date',
    'is_published' => 'boolean',
];

}
