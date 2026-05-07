<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DisasterReport extends Model
{


    protected $fillable = ['user_id','disaster_event_id','type','status','location_name','latitude','longitude','occurred_at','description','reporter_name','reporter_phone','verified_by','verified_at'];

protected $casts = [
    'metadata' => 'array',
    'occurred_at' => 'datetime',
    'resolved_at' => 'datetime',
    'verified_at' => 'datetime',
    'action_date' => 'date',
    'is_published' => 'boolean',
];

}
