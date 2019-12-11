<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'facebook', 'zalo', 'address', 'experience'
    ];
    public $timestamps = true;
}
