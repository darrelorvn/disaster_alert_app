<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationPreference extends Model
{


    protected $fillable = ['user_id','alert_filter','sound_enabled','push_enabled','email_enabled','metadata'];

protected $casts = [
    'metadata' => 'array',
    'occurred_at' => 'datetime',
    'resolved_at' => 'datetime',
    'verified_at' => 'datetime',
    'action_date' => 'date',
    'is_published' => 'boolean',
];

}
