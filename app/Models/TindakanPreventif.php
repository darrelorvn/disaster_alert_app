<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TindakanPreventif extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'aktivitas',
        'deskripsi',
        'waktu_tindakan',
        'lokasi',
        'foto',
    ];

    protected $casts = [
        'user_id'        => 'integer',
        'waktu_tindakan' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}