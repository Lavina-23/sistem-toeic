<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    use HasFactory;
    protected $table = 'peserta';
    protected $primaryKey = 'peserta_id';

    protected $fillable = [
        'pengguna_id',
        'nama',
        'no_induk',
        'nik',
        'no_telp',
        'tgl_lahir',
        'alamat_asal',
        'alamat_sekarang',
        'jurusan',
        'tgl_lahir',
        'program_studi',
        'kampus',
        'ktp',
        'ktm',
        'foto',
        'attempt_status'
    ];

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id', 'pengguna_id');
    }

    public function verificationPhotos()
    {
        return $this->hasMany(VerificationPhotos::class, 'peserta_id', 'peserta_id');
    }

    public function verifcationReq()
    {
        return $this->hasMany(VerificationReq::class, 'peserta_id', 'peserta_id');
    }

    public function score()
    {
        return $this->hasOne(Score::class, 'no_induk', 'no_induk');
    }
}
