<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::latest('id')->paginate(10);

        if ($faqs->isEmpty()) {
            return response()->json([
                'message' => 'Không có câu hỏi nào.'
            ], 200);
        }

        return response()->json([
            'message' => 'Lấy danh sách câu hỏi thành công.',
            'data' => $faqs
        ], 200);
    }

    public function create(Request $request)
    {
        $data = $request->validate(
            [
                'question' => 'required|string|max:255',
                'answer'   => 'required|string',
            ],
            [
                'question.required' => 'Vui lòng nhập câu hỏi.',
                'question.string'   => 'Câu hỏi phải là chuỗi.',
                'question.max'      => 'Câu hỏi không được vượt quá 255 ký tự.',
                'answer.required'   => 'Vui lòng nhập câu trả lời.',
                'answer.string'     => 'Câu trả lời phải là chuỗi.',
            ]
        );

        Faq::create($data);

        return response()->json([
            'message' => 'Tạo câu hỏi thành công.'
        ], 201);
    }

    public function show($id)
    {
        $faq = Faq::find($id);

        if (!$faq) {
            return response()->json([
                'message' => 'Không tìm thấy câu hỏi này.'
            ], 404);
        }

        return response()->json([
            'message' => 'Lấy câu hỏi thành công.',
            'data' => $faq
        ], 200);
    }

    public function update(Request $request, $id) 
    {
        $data = $request->validate(
            [
                'question' => 'required|string|max:255',
                'answer'   => 'required|string',
            ],
            [
                'question.required' => 'Vui lòng nhập câu hỏi.',
                'question.string'   => 'Câu hỏi phải là chuỗi.',
                'question.max'      => 'Câu hỏi không được vượt quá 255 ký tự.',
                'answer.required'   => 'Vui lòng nhập câu trả lời.',
                'answer.string'     => 'Câu trả lời phải là chuỗi.',
            ]
        );

        $faq = Faq::find($id);

        if (!$faq) {
            return response()->json([
                'message' => 'Không tìm thấy câu hỏi này.'
            ], 404);
        }

        $faq->update($data);

        return response()->json([
            'message' => 'Cập nhật câu hỏi thành công.'
        ], 200);
    }

    public function delete($id)
    {
        $faq = Faq::find($id);

        if (!$faq) {
            return response()->json([
                'message' => 'Không tìm thấy câu hỏi này.'
            ], 404);
        }

        $faq->delete();

        return response()->json([
            'message' => 'Xóa câu hỏi thành công.'
        ], 200);
    }
}
