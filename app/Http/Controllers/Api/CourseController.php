<?php

namespace App\Http\Controllers\Api;

use App\Services\CourseService;
use App\Traits\UploadFileTrait;
use Illuminate\Http\Request;
use App\Http\Requests\CourseRequest;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    use UploadFileTrait;
    private $courseService;

    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }

    public function index()
    {
        try {
            $course = $this->courseService->getCourses();
            return response()->json($course);
        } catch (Exception $e) {
            return response()->json(false);
        }
    }

    public function coursedRegister()
    {
        try {
            $coursed = $this->courseService->coursedRegister();
            return response()->json($coursed);
        } catch (Exception $e) {
            return response()->json(false);
        }
    }

    public function show($id)
    {
        try {
            $course = $this->courseService->showCourseDetail($id);
            return response()->json($course);
        } catch (Exception $e) {
            return response()->json(false);
        }
    }

    public function store(Request $request)
    {
        try {
            $fileNameImage = $this->uploadFile('uploads', $request->file('image'));
            $fileNameSocial = $this->uploadFile('uploads', $request->file('social_image'));
            $course = $this->courseService->create([
                'name' => $request->name,
                'slug' => $request->slug,
                'description' => $request->description,
                'intro' => $request->intro,
                'image' => $fileNameImage,
                'social_image' => $fileNameSocial,
                'teacher_id' => $request->teacher_id,
                'type' => $request->type,
            ]);
            return response()->json($course);
        } catch (Exception $e) {
            return response()->json(false);
        }
    }

    public function update(CourseRequest $request, $id)
    {
        try {
            $fileNameImage = $this->uploadFile('uploads', $request->image);
            $fileNameSocial = $this->uploadFile('uploads', $request->social_image);
            $updatedCourse = $this->courseService->update($id, [
                'name' => $request->name,
                'slug' => $request->slug,
                'description' => $request->description,
                'intro' => $request->intro,
                'image' => $fileNameImage,
                'social_image' => $fileNameSocial,
                'teacher_id' => $request->teacher_id,
                'type' => $request->type,
            ]);
            return response()->json($updatedCourse);
        } catch (Exception $e) {
            return response()->json(false);
        }
    }

    public function destroy($id)
    {
        try {
            $file = $this->courseService->findById($id)->image;
            $this->deleteFile('uploads', $file);
            $deleted = $this->courseService->delete($id);
            return response()->json($deleted);
        } catch (Exception $e) {
            return response()->json(false);
        }
    }
}
