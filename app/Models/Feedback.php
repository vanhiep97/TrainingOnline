<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = [
        'feedback',
        'user_id',
        'course_id',
        'lesson_id',
        'star',
    ];
    public $timestamps = true;
}
