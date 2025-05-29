<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerificationPhotos extends Model
{
    use HasFactory;
    protected $table = 'verificationPhotos';
    protected $primaryKey = 'id';

    protected $fillable = [
        'peserta_id',
        'photo_type',
        'photo_path',
    ];

    public function peserta()
    {
        return $this->belongsTo(Peserta::class, 'peserta_id', 'peserta_id');
    }
}
