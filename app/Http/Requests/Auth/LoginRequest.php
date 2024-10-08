<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => 'required|email',
            'password'=>'required'
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'xin hãy nhập email',
            'email.email'=>'email phải có @gmail.com',
            'password.required'=>'xin hãy nhập password'
        ];
    }
}
