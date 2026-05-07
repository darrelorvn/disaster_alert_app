<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MitigationNote extends Model
{


    protected $fillable = ['officer_id','title','disaster_type','affected_area','action_date','description','metadata'];

protected $casts = [
    'metadata' => 'array',
    'occurred_at' => 'datetime',
    'resolved_at' => 'datetime',
    'verified_at' => 'datetime',
    'action_date' => 'date',
    'is_published' => 'boolean',
];

}
