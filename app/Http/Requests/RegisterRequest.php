<?php

namespace App\Http\Requests;

use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'           => 'required|min:4|max:60',
            'email'          => 'bail|unique:users|required|email',
            'affiliate_code' => 'bail|unique:users|required',
            'phone'          => 'bail|unique:users|required|numeric|digits:10',
            'password'       => 'bail|required|min:6',
            'password_confirmation' => 'required_with:password|same:password|min:6'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập vào Username',
            'name.min' => 'Username tối thiểu 15 kí tự',
            'name.max' => 'Nhập vào Username tối đa 60 kí tự',
            'email.required' => 'Vui lòng nhập vào Email',
            'email.email' => 'Email nhập vào không đúng định dạng',
            'email.unique' => 'Email nhập vào đã tồn tại',
            'affiliate_code.required' => 'Vui lòng nhập vào affiliate code',
            'affiliate_code.unique' => 'Mã affiliate code đã tồn tại',
            'phone.required' => 'Vui lòng nhập vào số điện thoại',
            'phone.numeric' => 'Số điện thoại chỉ được nhập kí tự số',
            'phone.digits' => 'Số điện thoại chỉ được nhập 10 số',
            'phone.unique' => 'Số điện thoại đã tồn tại',
            'password.required' => 'Vui lòng nhập vào mật khẩu',
            'password.min' => 'Mật khẩu tối thiểu 6 kí tự',
            'password_confirmation.same' => 'Mật khẩu xác thực không đúng'
        ];
    }

    /**
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(response()->json(
            [
                'error' => $errors,
                'status_code' => 422,
            ], Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
