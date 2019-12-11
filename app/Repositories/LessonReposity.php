<?php
namespace App\Repositories;
use App\Models\Lesson;

class LessonReposity
{
    public function get($id)
    {
        return Lesson::find($id);
    }

    public function all($columns = ['*'])
    {
        return Lesson::get($columns);
    }

    public function findBy($column, $value)
    {
        return Lesson::where([$column => $value])->first();
    }

    public function query()
    {
        return Lesson::query();
    }
}
