<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:users,email',
            'password'=>'required|confirmed',
            'username'=>'required|max:21'
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'xin nhập mail',
            'email.unique'=>'email đã có sẵn',
            'email.email'=>'email phải có @gmail.com',
            'password.required'=>'Xin hãy nhập mật khẩu',
            'password.confirmed' => 'mật khẩu xác nhận không chính xác',
            'username.required'=>'xin hãy nhập tên người dùng',
            'username.max'=>'Tên người dùng tối đa 21 kí tự'
        ];
    }
}
