<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    const PATH_VIEW = 'admin.faqs.';

    // public function index()
    // {
    //     $faqs = Faq::latest('id')->paginate(10);

    //     // if ($faqs->isEmpty()) {
    //     //     return view(self::PATH_VIEW . __FUNCTION__)->with('error', 'Chưa có câu hỏi nào được tạo!');
    //     // }

    //     return view(self::PATH_VIEW . __FUNCTION__, compact('faqs'));
    // }
    

    public function create()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    public function store(Request $request)
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

        return redirect()->route(self::PATH_VIEW . 'index')->with('success', 'Tạo câu hỏi thành công.');
    }

    public function edit($id)
    {
        $faq = Faq::find($id);

        if (!$faq) {
            return back()->with('error', 'Không tìm thấy câu hỏi này.');
        }

        return view(self::PATH_VIEW . __FUNCTION__, compact('faq'));
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
            return back()->with('error', 'Không tìm thấy câu hỏi này.');
        }

        $faq->update($data);

        return back()->with('success', 'Cập nhật câu hỏi thành công.');
    }

    public function destroy($id)
    {
        $faq = Faq::find($id);

        if (!$faq) {
            return back()->with('error', 'Không tìm thấy câu hỏi này.');
        }

        $faq->delete();

        return back()->with('success', 'Xóa câu hỏi thành công.');
    }
}
