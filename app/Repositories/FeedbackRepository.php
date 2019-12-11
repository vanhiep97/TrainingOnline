<?php

namespace App\Repositories;

use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;

class FeedbackRepository
{
    public function get($id)
    {
        return Feedback::find($id);
    }

    public function all($columns = ['*'])
    {
        return Feedback::get($columns);
    }

    public function findBy($column, $value)
    {
        return Feedback::where([$column => $value])->first();
    }

    public function query()
    {
        return Feedback::query();
    }

    public function userLogin()
    {
        return Auth::user();
    }
}
