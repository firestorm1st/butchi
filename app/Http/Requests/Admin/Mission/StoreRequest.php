<?php

namespace App\Http\Requests\Admin\Mission;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => 'required|unique:missions,name',
            'day' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email phải có đuôi @gmail.com',
            'fullname.required' => 'Vui lòng nhập tên',
            'message.required' => 'Vui lòng để lại lời nhắn'
        ];
    }
}
