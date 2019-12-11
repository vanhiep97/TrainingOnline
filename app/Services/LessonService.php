<?php
namespace App\Services;
use App\Repositories\LessonReposity;

class LessonService
{
    protected $lessonReposity;
    public function __construct(LessonReposity $lessonReposity)
    {
        $this->lessonReposity = $lessonReposity;
    }

    public function findById($id)
    {
        return $this->lessonReposity->get($id);
    }

    public function create($lesson)
    {
        return $this->lessonReposity->query()->create($lesson);
    }

    public function update($id, $lesson)
    {
        return $this->lessonReposity->get($id)->update($lesson);
    }

    public function delete($id)
    {
        return $this->lessonReposity->get($id)->delete();
    }
}

