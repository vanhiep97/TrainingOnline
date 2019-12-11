<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\LessonUpdateRequest;
use App\Traits\UploadFileGoogleDriveTrait;
use App\Traits\UploadFileTrait;
use App\Services\LessonService;
use Illuminate\Http\Request;
use App\Http\Requests\LessonCreateRequest;
use App\Http\Controllers\Controller;

class LessonController extends Controller
{
    use UploadFileTrait;
    use UploadFileGoogleDriveTrait;
    protected $lessonService;

    public function __construct(LessonService $lessonService)
    {
        $this->lessonService = $lessonService;
    }

    public function create(LessonCreateRequest $request)
    {
        try {
            if ($request->action == 'upload-server') {
                $videoName = $this->uploadFile('uploads', $request->video);
                $lesson = $this->lessonService->create([
                    'course_id' => $request->course_id,
                    'name' => $request->name,
                    'slug' => $request->slug,
                    'video' => $videoName,
                    'content' => $request->contain,
                    'seo_description' => $request->seo_description,
                    'seo_keyword' => $request->seo_keyword,
                ]);
                return response()->json($lesson);
            }
            if ($request->action == 'upload-driver') {
                $videoName = $this->uploadFileDrive($request->video);
                $lesson = $this->lessonService->create([
                    'course_id' => $request->course_id,
                    'name' => $request->name,
                    'slug' => $request->slug,
                    'video' => $videoName,
                    'content' => $request->contain,
                    'seo_description' => $request->seo_description,
                    'seo_keyword' => $request->seo_keyword,
                ]);
                return response()->json($lesson);
            }
        } catch (Exception $e) {
            return response(false);
        }
    }

    public function update(LessonUpdateRequest $request, $id)
    {
        try {
            if ($request->action == 'upload-server') {
                $videoName = $this->uploadFile('uploads', $request->video);
                $lessoned = $this->lessonService->update($id, [
                    'course_id' => $request->course_id,
                    'name' => $request->name,
                    'slug' => $request->slug,
                    'video' => $videoName,
                    'content' => $request->contain,
                    'seo_description' => $request->seo_description,
                    'seo_keyword' => $request->seo_keyword,
                ]);
                return response()->json($lessoned);
            }
            if ($request->action == 'upload-driver') {
                $videoName = $this->uploadFileDrive($request->video);
                $lessoned = $this->lessonService->update($id, [
                    'course_id' => $request->course_id,
                    'name' => $request->name,
                    'slug' => $request->slug,
                    'video' => $videoName,
                    'content' => $request->contain,
                    'seo_description' => $request->seo_description,
                    'seo_keyword' => $request->seo_keyword,
                ]);
                return response()->json($lessoned);
            }
        } catch (Exception $e) {
            return response(false);
        }
    }

    public function destroy($id)
    {
        try {
            $file = $this->lessonService->findById($id)->video;
            $this->deleteFile('uploads', $file);
            $this->deleteFileDrive($file);
            $deleted = $this->lessonService->delete($id);
            return response()->json($deleted);
        } catch (Exception $e) {
            return response()->json(false);
        }
    }
}
