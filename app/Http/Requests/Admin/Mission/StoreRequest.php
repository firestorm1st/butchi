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
            'name' => 'required',
            'day' => 'required|unique:missions,day'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Vui lòng nhập nội dung nhiệm vụ',
            'day.required' => 'Vui lòng nhập ngày áp dụng',
            'day.unique' => 'Đã có nhiệm vụ trong ngày vừa nhập, vui lòng chọn ngày khác'
        ];
    }
}
