<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AiRecomendation extends Model
{
    protected $fillable = [
        'user_id',
        'role',
        'recommendation_text',
        'context_summary',
        'generated_at',
        'expires_at',
    ];

    protected $casts = [
        'generated_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
