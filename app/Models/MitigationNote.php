<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MitigationNote extends Model
{
    protected $fillable = [
        'officer_id',
        'disaster_event_id',
        'title',
        'disaster_type',
        'affected_area',
        'action_date',
        'description',
        'metadata',
    ];

    protected $casts = [
        'metadata' => 'array',
        'action_date' => 'date',
    ];

    public function officer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'officer_id');
    }

    public function disasterEvent(): BelongsTo
    {
        return $this->belongsTo(DisasterEvent::class);
    }
}
