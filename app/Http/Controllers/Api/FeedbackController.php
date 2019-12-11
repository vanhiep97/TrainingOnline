<?php

namespace App\Http\Controllers\Api;

use App\Services\FeedbackService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FeedbackController extends Controller
{
    protected $feedbackService;
    public function __construct(FeedbackService $feedbackService)
    {
        $this->feedbackService = $feedbackService;
    }

    public function feedbackCourse(Request $request)
    {
        try {
            $feedback = $this->feedbackService->create([
                'feedback' => $request->feedback,
                'user_id' => $this->feedbackService->getUserLogin(),
                'course_id' => $request->course_id,
                'star' => $request->star,
            ]);
            return response()->json($feedback);
        } catch (Exception $e) {
            return response()->json(false);
        }
    }

    public function feedbackLesson(Request $request)
    {
        try {
            $feedback = $this->feedbackService->create([
                'feedback' => $request->feedback,
                'user_id' => $this->feedbackService->getUserLogin(),
                'lesson_id' => $request->lesson_id,
                'star' => $request->star,
            ]);
            return response()->json($feedback);
        } catch (Exception $e) {
            return response()->json(false);
        }
    }

    public function getFeedback()
    {
        try {
            $feedback = $this->feedbackService->getAllFeedback();
            return response()->json($feedback);
        } catch (Exception $e) {
            return response()->json(false);
        }
    }
}
