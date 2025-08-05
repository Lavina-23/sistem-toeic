<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerificationReq extends Model
{
    use HasFactory;

    protected $table = 'verification_req';

    protected $fillable = [
        'pengguna_id',
        'keterangan',
        'bukti_pendukung',
        'score_total',
        'last_score_total',
        'alasan'
    ];


    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id', 'pengguna_id');
    }
}
