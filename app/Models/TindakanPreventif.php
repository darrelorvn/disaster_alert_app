<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TindakanPreventif extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'waktu_tindakan',
        'aktivitas',
        'foto_bukti',
    ];

    protected $casts = [
        'waktu_tindakan' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}