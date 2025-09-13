<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pengguna extends Authenticatable
{
    use Notifiable;

    protected $table = 'pengguna';

    protected $fillable = [
        'nama',
        'email',
        'password',
        'tipe_pengguna',
        'no_telepon',
        'alamat'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
