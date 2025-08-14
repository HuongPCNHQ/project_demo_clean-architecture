<?php

namespace App\Interfaces\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ChangePassRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Cho phép request luôn được xử lý
    }

    public function rules(): array
    {
        return [
            'current_password' => ['required'],
            'new_password' => [
                'required',
                'confirmed', // cần có password_confirmation
                'min:8',
                'regex:/[a-z]/',      // chữ thường
                'regex:/[A-Z]/',      // chữ hoa
                'regex:/[0-9]/',      // số
                'regex:/[@$!%*#?&]/'  // ký tự đặc biệt
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'current_password.required' => 'Vui lòng nhập mật khẩu hiện tại',
            'new_password.required' => 'Vui lòng nhập mật khẩu mới',
            'new_password.min' => 'Mật khẩu phải ít nhất 8 ký tự',
            'new_password.regex' => 'Mật khẩu phải chứa ít nhất một chữ thường, một chữ hoa, một số và một ký tự đặc biệt',
            'new_password.confirmed' => 'Mật khẩu xác nhận không khớp',
        ];
    }

    /**
     * Khi validate fail — với API ta trả JSON (không redirect view).
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        $payload = [
            'success' => false,
            'message' => 'Validation error',
            'errors'  => $validator->errors()
        ];

        throw new HttpResponseException(response()->json($payload, 422));
    }
}
