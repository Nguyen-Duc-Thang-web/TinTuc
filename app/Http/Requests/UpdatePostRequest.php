<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:posts,slug,' . $this->route('id'),
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
            'is_active' => 'required|boolean',
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'Tác giả không được để trống.',
            'user_id.exists' => 'Tác giả không tồn tại.',

            'category_id.required' => 'Danh mục không được để trống.',
            'category_id.exists' => 'Danh mục không tồn tại.',

            'title.required' => 'Tiêu đề bài viết không được để trống.',
            'title.string' => 'Tiêu đề bài viết phải là chuỗi.',
            'title.max' => 'Tiêu đề bài viết không được vượt quá 255 ký tự.',

            'slug.required' => 'Slug không được để trống.',
            'slug.string' => 'Slug phải là chuỗi.',
            'slug.max' => 'Slug không được vượt quá 255 ký tự.',
            'slug.unique' => 'Slug đã tồn tại.',

            'description.required' => 'Mô tả bài viết không được để trống.',
            'description.max' => 'Mô tả bài viết không được vượt quá 100 ký tự.',

            'content.required' => 'Nội dung bài viết không được để trống.',

            'image.image' => 'Ảnh không đúng định dạng.',
            'image.mimes' => 'Ảnh phải có định dạng jpeg, png, jpg hoặc gif.',
            'image.max' => 'Ảnh không được vượt quá 2MB.',

            'is_active.required' => 'Trạng thái hoạt động không được để trống.',
            'is_active.boolean' => 'Trạng thái hoạt động phải là kiểu boolean.',
        ];
    }
}
