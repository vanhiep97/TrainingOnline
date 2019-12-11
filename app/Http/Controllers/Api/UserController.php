<?php

namespace App\Http\Controllers\Api;

use App\Services\UserService;
use App\Traits\UploadFileTrait;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ChangePwdRequest;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    use UploadFileTrait;
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(RegisterRequest $request)
    {
        try {
            $user = $this->userService->register([
                'name' => $request->name,
                'email' => $request->email,
                'affiliate_code' => $request->affiliate_code,
                'phone' => $request->phone,
                'password' => bcrypt($request->password),
            ]);
            return response()->json($user);
        } catch (Exception $e) {
            return response()->json(false);
        }
    }

    public function users()
    {
        try {
            $user = $this->userService->getAllUserByColumns('1');
            return response()->json($user);
        } catch (Exception $e) {
            return response()->json(false);
        }
    }

    public function changePwd(ChangePwdRequest $request)
    {
        try {
            $user = $this->userService->changePwd([
                'password' => bcrypt($request->passwordnew),
            ]);
            return response()->json($user);
        } catch (Exception  $e) {
            return response()->json(false);
        }
    }

    public function updateProfile(Request $request)
    {
        try {
            $fileName = $this->uploadFile('uploads', $request->avatar);
            $user = $this->userService->updateProfile([
                'avatar' => $fileName,
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
            ]);
            return response()->json($user);
        } catch (Exception $e) {
            return response()->json(false);
        }
    }
}
