<?php

namespace App\Repositories;
use App\Models\Course;

class CourseRepository
{
    public function get($id)
    {
        return Course::find($id);
    }

    public function all($columns = ['*'])
    {
        return Course::get($columns);
    }

    public function findBy($column, $value)
    {
        return Course::where([$column => $value])->first();
    }

    public function query()
    {
        return Course::query();
    }
}

