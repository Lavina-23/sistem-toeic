<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengguna extends Authenticatable
{
    use HasFactory;
    protected $table = 'pengguna';
    protected $primaryKey = 'pengguna_id';

    protected $fillable = [
        'nama',
        'email',
        'password',
        'level',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = ['password' => 'hashed'];

    public function peserta()
    {
        return $this->hasOne(Peserta::class, 'pengguna_id', 'pengguna_id');
    }
}
