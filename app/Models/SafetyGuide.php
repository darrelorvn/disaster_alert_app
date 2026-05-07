<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SafetyGuide extends Model
{


    protected $fillable = ['title','disaster_type','category','content','video_url','is_published'];

protected $casts = [
    'metadata' => 'array',
    'occurred_at' => 'datetime',
    'resolved_at' => 'datetime',
    'verified_at' => 'datetime',
    'action_date' => 'date',
    'is_published' => 'boolean',
];

}
