<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();

        if ($contacts->isEmpty()) {
            return response()->json([
                'message' => 'Không có liên hệ nào.',
            ], 200);
        }

        return response()->json([
            'message' => 'Lấy danh sách liên hệ thành công.',
            'data' => $contacts,
        ], 200);
    }

    public function create(Request $request)
    {
        $data = $request->validate(
            [
                'name'    => 'required|string|max:255',
                'email'   => 'required|email|max:255',
                'title'   => 'required|string|max:255',
                'content' => 'required|string',
            ],
            [
                'name.required'     => 'Vui lòng nhập tên của bạn.',
                'name.string'       => 'Tên của bạn phải là chuỗi.',
                'name.max'          => 'Tên của bạn không được vượt quá 255 ký tự.',
                'email.required'    => 'Vui lòng nhập email của bạn.',
                'email.email'       => 'Email của bạn không đúng định dạng.',
                'email.max'         => 'Email của bạn không được vượt quá 255 ký tự.',
                'title.required'    => 'Vui lòng nhập tiêu đề tin nhắn.',
                'title.string'      => 'Tiêu đề tin nhắn phải là chuỗi.',
                'title.max'         => 'Tiêu đề tin nhắn không được vượt quá 255 ký tự.',
                'content.required'  => 'Vui lòng nhập nội dung tin nhắn.',
                'content.string'    => 'Nội dung tin nhắn phải là chuỗi.',
            ]
        );

        Contact::create($data);

        return response()->json([
            'message' => 'Gửi liên hệ thành công.',
        ], 201);
    }

    public function show($id)
    {
        $contact = Contact::find($id);

        if (!$contact) {
            return response()->json([
                'message' => 'Không tìm thấy liên hệ này.',
            ], 404);
        }

        return response()->json([
            'message' => 'Lấy thông tin liên hệ thành công.',
            'data' => $contact,
        ], 200);
    }

    public function delete($id)
    {
        $contact = Contact::find($id);

        if (!$contact) {
            return response()->json([
                'message' => 'Không tìm thấy liên hệ này.',
            ], 404);
        }

        $contact->delete();

        return response()->json([
            'message' => 'Xóa liên hệ thành công.',
        ], 200);
    }
}