<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    const PATH_VIEW = 'admin.contacts.';

    public function index()
    {
        $contacts = Contact::latest('id')->paginate(10);

        // if ($contacts->isEmpty()) {
        //     return back()->with('error', 'Chưa có liên hệ nào được gửi!');
        // }

        return view(self::PATH_VIEW . __FUNCTION__, compact('contacts'));
    }

    public function show($id)
    {
        $contact = Contact::find($id);

        if (!$contact) {
            return back()->with('error', 'Không tìm thấy liên hệ này.');
        }

        return view(self::PATH_VIEW . __FUNCTION__, compact('contact'));
    }

    public function destroy($id)
    {
        $contact = Contact::find($id);

        if (!$contact) {
            return back()->with('error', 'Không tìm thấy liên hệ này.');
        }

        $contact->delete();

        return back()->with('success', 'Xóa liên hệ thành công.');
    }
}
