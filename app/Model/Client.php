<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
    protected $table = 'client';
    
    protected $primaryKey = 'id';

    protected $fillable = [
        'clientname',
        'email',
        'address',
        'city',
        'contact',
    ];
}
