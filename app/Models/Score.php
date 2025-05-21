<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;
    protected $table = 'scores';
    protected $primaryKey = 'score_id';
    protected $fillable = [
        'result_no',
        'name',
        'student_id',
        'score_l',
        'score_r',
        'score_total',
        'group',
        'position',
        'category',
        'test_date',
        'last_score_l',
        'last_score_r',
        'last_score_total',
    ];
}
