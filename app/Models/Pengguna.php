<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pengguna extends Authenticatable implements MustVerifyEmail
{
    use HasFactory;
    use Notifiable;
    protected $table = 'pengguna';
    protected $primaryKey = 'pengguna_id';

    protected $fillable = [
        'no_induk',
        'nama',
        'email',
        'password',
        'level',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = ['password' => 'hashed', 'email_verified_at' => 'datetime'];

    public function peserta()
    {
        return $this->hasOne(Peserta::class, 'pengguna_id', 'pengguna_id');
    }
}
