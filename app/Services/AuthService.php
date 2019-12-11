<?php
namespace App\Services;
use App\Mail\SendMail;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\CodeVerify;

class  AuthService {

    private $user;
    private $codeVerifies;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function login($credentials)
    {
        return JWTAuth::attempt($credentials);
    }

    public function logout($token)
    {
        return JWTAuth::invalidate($token);
    }

    public function createVerityCode($user) {
        return CodeVerify::create($user);
    }

    public function updateVerityCode($valueWhere, $user) {
        return CodeVerify::where('user_id', $valueWhere)->update($user);
    }

    public function getUserByColumns($columns, $valueDb, $valueWhere) {
        return User::select($columns)->where($valueDb, $valueWhere)->get();
    }

    public function getVerifyByColumns($columns, $valueDb, $valueWhere) {
        return CodeVerify::select($columns)->where($valueDb, $valueWhere)->get();
    }

    public function getAllVerifiCodeById($valueWhere) {
        return CodeVerify::where('user_id', $valueWhere)->get();
    }
}
