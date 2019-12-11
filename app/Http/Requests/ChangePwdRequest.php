<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use App\Rules\VetifyPassword;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class ChangePwdRequest extends FormRequest
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
            'passwordold' => ['required', new VetifyPassword],
            'passwordnew' => 'required_with:passwordold|different:passwordold|min:6',
        ];
    }

    public function messages()
    {
        return [
            'passwordold.required' => 'Vui lòng nhập vào mật khẩu xác thực',
            'passwordnew.required_with' => 'Vui lòng nhập vào mật khẩu mới',
            'passwordnew.min' => 'Nhập vào mật khẩu mới tối thiểu 6 kí tự',
            'passwordnew.different' => 'Password mới không được trùng password hiện tại'
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
