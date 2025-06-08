<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerificationReq extends Model
{
    use HasFactory;

    protected $table = 'verification_req';

    protected $fillable = [
        'peserta_id',
        'keterangan',
        'bukti_pendukung',
    ];


    public function peserta()
    {
        return $this->belongsTo(Peserta::class);
    }
}
