<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Clienthistory extends Model
{
    //
    protected $table = 'clienthistory';
    
    protected $primaryKey = 'id';

    protected $fillable = [
        'lastname',
        'firstname',
        'middlename',
        'email',
        'pastclient'
    ];
}
