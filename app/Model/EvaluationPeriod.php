<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class EvaluationPeriod extends Model
{
    protected $table = 'evaluation_period';
    protected $primaryKey = 'id';
    protected $fillable = [
        'client_id'
    ];

}
