<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'intro',
        'image',
        'social_image',
        'teacher_id',
        'type',
    ];
    public $timestamps = true;
}
