<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employee';
    protected $primaryKey = 'id';
    protected $fillable = [
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
