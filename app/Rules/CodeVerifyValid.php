<?php

namespace App\Rules;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Services\CodeVerifyService;

class CodeVerifyValid implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return !empty(app(CodeVerifyService::class)->getByVerifyCodeActive($value));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Mã xác nhận không chính xác hoặc đã hết hạn';
    }
}
