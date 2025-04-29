<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    use HasFactory;
    protected $table = 'pengguna';
    protected $primaryKey = 'pengguna_id';
    protected $fillable = [
        'email',
        'password',
        'level',
    ];
    public function peserta()
    {
        return $this->hasOne(Peserta::class, 'pengguna_id', 'pengguna_id');
    }
}
