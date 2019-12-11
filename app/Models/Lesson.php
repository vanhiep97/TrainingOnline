<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'video',
        'content',
        'seo_description',
        'seo_keyword',
        'course_id',
    ];
    public $timestamps = true;
}
