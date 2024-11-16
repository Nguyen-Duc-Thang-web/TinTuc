<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAdvertisementRequest extends FormRequest
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
            'user_id'       => ['required', 'integer', 'exists:users,id'],
            'category_id'   => ['nullable', 'integer', 'exists:categories,id'],
            'pages'         => ['nullable', 'string', 'in:home,post_detail'],
            'position'      => ['required', 'string', 'in:header,middle,bottom,sidebar'],
            'image'         => ['nullable', 'image', 'max:2048'],
            'link'          => ['required', 'url'],
            'start_date'    => ['required', 'date', 'after_or_equal:today'],
            'end_date'      => ['required', 'date', 'after:start_date'],
            'status'        => ['required', 'in:draft,active,paused,completed'],
            'content'       => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'user_id.required'      => 'Người tạo quảng cáo là bắt buộc.',
            'user_id.integer'       => 'Người dùng không hợp lệ.',
            'user_id.exists'        => 'Người dùng không tồn tại.',

            'category_id.integer'   => 'Danh mục hiển thị quảng cáo không hợp lệ.',
            'category_id.exists'    => 'Danh mục hiển thị quảng cáo không tồn tại.',

            'pages.string'          => 'Trang hiển thị quảng cáo không hợp lệ.',
            'pages.in'              => 'Trang hiển thị quảng cáo không hợp lệ.',

            'position.required'     => 'Vị trí hiển thị quảng cáo là bắt buộc.',
            'position.string'       => 'Vị trí hiển thị quảng cáo không hợp lệ.',
            'position.in'           => 'Vị trí hiển thị quảng cáo không hợp lệ.',

            'image.image'           => 'Hình ảnh quảng cáo không hợp lệ.',
            'image.max'             => 'Hình ảnh quảng cáo không được vượt quá 2MB.',

            'link.required'         => 'Liên kết quảng cáo là bắt buộc.',
            'link.url'              => 'Liên kết quảng cáo không hợp lệ.',

            'start_date.required'   => 'Ngày bắt đầu hiển thị quảng cáo là bắt buộc.',
            'start_date.date'       => 'Ngày bắt đầu hiển thị quảng cáo không hợp lệ.',
            'start_date.after_or_equal' => 'Ngày bắt đầu hiển thị quảng cáo phải lớn hơn hoặc bằng ngày hiện tại.',

            'end_date.required'     => 'Ngày kết thúc hiển thị quảng cáo là bắt buộc.',
            'end_date.date'         => 'Ngày kết thúc hiển thị quảng cáo không hợp lệ.',
            'end_date.after'        => 'Ngày kết thúc hiển thị quảng cáo phải lớn hơn ngày bắt đầu.',

            'status.required'       => 'Trạng thái quảng cáo là bắt buộc.',
            'status.in'             => 'Trạng thái quảng cáo không hợp lệ.',

            'content.string'        => 'Nội dung quảng cáo không hợp lệ.',
            'content.max'           => 'Nội dung quảng cáo không được vượt quá 255 ký tự.',
        ];
    }
    
    protected function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            if ($this->input('pages') && $this->input('category_id')) {
                $validator->errors()->add('both_value', 'Vui lòng chỉ chọn một trang hoặc một danh mục duy nhất.');
            } 
            if (!$this->input('pages') && !$this->input('category_id')) {
                $validator->errors()->add('category_or_page_required', 'Vui lòng chọn ít nhất một trang hoặc danh mục.');
            }
        });
    }
}
