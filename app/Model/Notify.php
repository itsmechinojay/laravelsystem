<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Notify extends Model
{
    //
    protected $table = 'notify';
    
    protected $primaryKey = 'id';

    protected $fillable = [
        'sender',
        'action',
        'sendto',
    ];
}
