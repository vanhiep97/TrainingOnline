<?php

namespace App\Services;

use App\Models\CodeVerify;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class CodeVerifyService
{
    public function create($code, int $userId)
    {
        return CodeVerify::create([
            'verify_code' => $code,
            'user_id'     => $userId,
        ]);
    }

    public function getByVerifyCodeActive($code)
    {
        return CodeVerify::whereNull('verify_at')
            ->where(['verify_code' => $code])
            ->where( 'created_at', '>', Carbon::now()->subMinutes(15))
            ->first();
    }

    public function expireVerifyCodeActive($code)
    {
        return CodeVerify::where(['verify_code' => $code])->update(['verify_at' => Carbon::now()]);
    }
}
