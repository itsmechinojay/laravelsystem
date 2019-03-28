<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    //
    protected $table = 'criteria';
    
    protected $primaryKey = 'id';

    protected $fillable = [
        'criteria'
    ];
}

