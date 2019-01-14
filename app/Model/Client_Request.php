<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Client_Request extends Model
{
    //
    protected $table = 'client_request';
    
    protected $primaryKey = 'id';

    protected $fillable = [
        'client_id',
        'status',
        'position',
        'description',
        'needed',
    ];
}
