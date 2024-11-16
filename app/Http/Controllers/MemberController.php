<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{
    public function showProfile()
    {
        $user = Auth::user();

        return view('clients.profile', compact('user'));
    }

    public function changePassword(Request $request)
    {

        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'renew_password' => 'required|same:new_password',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors([
                'old_password' => 'Mật khẩu hiện tại không đúng.'
            ]);
        }

        $user->password = Hash::make($request->new_password);

        /**
         * @var Use $user
         */

        $user->save();

        return back()->with('success', 'Đổi mật khẩu thành công');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('profile_images', 'public');
            $user->image = $imagePath;
        }

        $user->name = $request->input('name');

        /**
         * @var Use $user
         */

        $user->save();

        return redirect()->back()->with('success', 'Cập nhật thông tin thành công');
    }
}
