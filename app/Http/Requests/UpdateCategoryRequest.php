<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
        $category = Category::where('slug', $this->route('slug'))->first();

        return [
            'name'       => ['required', 'string', 'max:50', 'unique:categories,name,' . ($category ? $category->id : 'NULL')],
            'image'      => ['image', 'max:2048'],
            'is_active'  => ['boolean'],
        ];
    }

    public function messages()
    {
        return [
            'name.required'       => 'Tên danh mục không được để trống.',
            'name.string'         => 'Tên danh mục phải là chuỗi.',
            'name.max'            => 'Tên danh mục không được vượt quá 50 ký tự.',

            'image.image'         => 'Ảnh không đúng định dạng.',
            'image.max'           => 'Ảnh không được vượt quá 2MB.',

            'is_active.boolean'   => 'Trạng thái phải là kiểu boolean.',
        ];
    }
}
