<?php
namespace App\Services;

use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class MailService
{
    public function forgotPassword($subject, $email, $message)
    {
        return Mail::to($email)->send(new SendMail($subject, $message));
    }
}
