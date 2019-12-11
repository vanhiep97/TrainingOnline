<?php

namespace App\Http\Requests;
use App\Rules\VetifyEmail;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class ForgotPasswordRequest extends FormRequest
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
            'email' => ['required', 'email', new VetifyEmail]
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Vui lòng nhập vào tài khoản email',
            'email.email'    => 'Nhập đúng định dạng email',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(response()->json([
            'messages' => $errors,
            'code' => 422,
        ], Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
