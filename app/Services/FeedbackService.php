<?php
namespace App\Services;
use App\Repositories\FeedbackRepository;

class FeedbackService
{
    protected $feedbackRepository;
    public function __construct(FeedbackRepository $feedbackRepository)
    {
        $this->feedbackRepository = $feedbackRepository;
    }

    public function getUserLogin()
    {
        return $this->feedbackRepository->userLogin()->id;
    }

    public function create($feedback)
    {
        return $this->feedbackRepository->query()->create($feedback);
    }

    public function getAllFeedback()
    {
        return $this->feedbackRepository->all();
    }
}
