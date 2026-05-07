<?php

    namespace App\Models;

    use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

    class User extends Authenticatable
    {
        use Notifiable;

        protected $fillable = ['name','email','password','phone','role','staff_id','agency','position','profile_photo_path'];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'metadata' => 'array',
        ];
    }

    }
