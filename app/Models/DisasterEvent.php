<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DisasterEvent extends Model
{


    protected $fillable = ['type','status','source','title','summary','location_name','latitude','longitude','occurred_at','resolved_at','metadata'];

protected $casts = [
    'metadata' => 'array',
    'occurred_at' => 'datetime',
    'resolved_at' => 'datetime',
    'verified_at' => 'datetime',
    'action_date' => 'date',
    'is_published' => 'boolean',
];

}
