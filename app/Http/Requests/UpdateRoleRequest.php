<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:roles,name,' . $this->route('role')->id,
        ];
    }


    public function messages(): array
    {
        return [
            'name.required' => 'Trường tên không được để trống.',
            'name.string' => 'Trường tên phải là một chuỗi.',
            'name.max' => 'Trường tên không được vượt quá 255 ký tự.',
            'name.unique' => 'Trường tên đã tồn tại. Vui lòng chọn tên khác.',
        ];
    }
}
