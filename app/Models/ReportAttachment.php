<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportAttachment extends Model
{


    protected $fillable = ['disaster_report_id','file_path','caption','mime_type','size'];

protected $casts = [
    'metadata' => 'array',
    'occurred_at' => 'datetime',
    'resolved_at' => 'datetime',
    'verified_at' => 'datetime',
    'action_date' => 'date',
    'is_published' => 'boolean',
];

}
