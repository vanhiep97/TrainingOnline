<?php

namespace App\Http\Controllers\Api;

use App\Services\MailService;
use App\Services\CodeVerifyService;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\SetPasswordRequest;

class ForgotPasswordController extends Controller
{
    private $mailService;
    private $codeVerifyService;
    private $userService;

    public function __construct(MailService $mailService, CodeVerifyService $codeVerifyService, UserService $userService)
    {
        $this->mailService       = $mailService;
        $this->codeVerifyService = $codeVerifyService;
        $this->userService       = $userService;
    }

    public function getCodeVerify(ForgotPasswordRequest $request)
    {
        try {
            $codeVerify = random_int(112345, 956789);
            $user       = $this->userService->findByEmail($request->email);
            $subject    = '[SUNTECH VIỆT NAM] Email forgot password!';
            $this->mailService->forgotPassword($subject, $request->email, $codeVerify);
            $this->codeVerifyService->create($codeVerify, $user->id);

            return response()->json(true);
        } catch(Exception $e) {
            return response()->json(false);
        }
    }

    public function resetPassword(SetPasswordRequest $request)
    {
        try {
            $verifyCode = $this->codeVerifyService->getByVerifyCodeActive($request->verify_code);
            $updated    = $this->userService->updateById($verifyCode->user_id, ['password' => bcrypt($request->password)]);
            $this->codeVerifyService->expireVerifyCodeActive($verifyCode->verify_code);

            return response()->json($updated);
        } catch(Exception $e) {
            return response()->json(false);
        }
    }
}
