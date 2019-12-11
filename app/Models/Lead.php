<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'lead',
        'affiliate_code',
        'course_id',
    ];
    public $timestamps = true;
}
