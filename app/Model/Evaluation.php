<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $table = 'evaluation';
    protected $primaryKey = 'id';
    protected $fillable = [
        'evalperiod_id',
        'emp_id',
        'criteria_id',
        'rating'
    ];

}
