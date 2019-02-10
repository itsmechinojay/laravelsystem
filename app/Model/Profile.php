<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    // 
    protected $table = 'profile';
    protected $primaryKey = 'id';
    protected $fillable = [
        'profilepic',
        'resume',
        'lastname',
        'firstname',
        'middlename',
        'position',
        'gender',
        'bday',
        'email',
        'address',
        'city',
        'contact',
        'client',
        'status',
    ];
}
