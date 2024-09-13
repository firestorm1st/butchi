<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class registerRequest extends FormRequest
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
            'username'=>'required'
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'please enter email',
            'email.unique'=>'email already esixts',
            'email.email'=>'email must have @gmail.com',
            'password.required'=>'please enter password',
            'password.confirmed' => 'Re-entered password does not match',
            'username.required'=>'please enter username'
        ];
    }
}
