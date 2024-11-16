<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // Assuming your User model is in this namespace


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    //     public function index()
    // {
    //     // Lấy danh sách tất cả người dùng từ database
    //     $users = User::all(); // Hoặc sử dụng paginate() nếu bạn muốn phân trang
    //     // dd($users);
    //     // Hiển thị dữ liệu người dùng trong view và truyền danh sách user vào view
    //     return view('admin.user.index', compact('users'));
    // }
    public function index(Request $request)
    {
        // Kiểm tra nếu có tham số query (id người dùng)
        if ($request->has('query')) {
            // Lọc người dùng theo id (query)
            $userId = $request->query('query');
            $users = User::where('id', $userId)->paginate(20);
        } else {
            // Nếu không có query, lấy tất cả người dùng
            $users = User::paginate(20); // Hoặc sử dụng all() nếu không cần phân trang
        }

        // Trả về view với dữ liệu
        return view('admin.user.index', compact('users'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate form input, including the avatar file
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:8',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_active' => 'required|in:0,1',
            'social_provider' => 'nullable|string|in:facebook,google',
            'social_id' => 'nullable|string|max:255',
        ]);

        // Create the new user
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->is_active = $request->is_active;
        $user->social_provider = $request->social_provider;
        $user->social_id = $request->social_id;

        // Handle the avatar upload
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/avatars', $filename, 'public');
            $user->avatar = '/storage/' . $filePath; // Lưu đường dẫn avatar vào database
        }

        // Save the user
        $user->save();

        // Redirect back to the user list with success message
        return redirect()->route('admin.users.index')->with('success', 'Người dùng đã được thêm mới thành công!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Tìm user theo ID
        $user = User::findOrFail($id);

        // Trả về view edit với dữ liệu user
        return view('admin.user.edit', compact('user'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate dữ liệu
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id, // Kiểm tra email trùng
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Avatar có thể null và giới hạn kích thước
            'is_active' => 'required|boolean',
        ]);

        // Tìm user theo ID
        $user = User::findOrFail($id);

        // Cập nhật dữ liệu người dùng
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->is_active = $request->input('is_active');

        // Xử lý ảnh avatar nếu có tải lên
        if ($request->hasFile('avatar')) {
            // Xóa ảnh cũ nếu tồn tại
            if ($user->avatar) {
                $oldAvatarPath = public_path($user->avatar); // Lấy đường dẫn ảnh cũ
                if (file_exists($oldAvatarPath)) {
                    unlink($oldAvatarPath); // Xóa ảnh cũ
                }
            }

            // Lưu avatar mới vào thư mục storage
            $file = $request->file('avatar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/avatars', $filename, 'public');
            $user->avatar = '/storage/' . $filePath; // Cập nhật đường dẫn avatar mới vào database
        }

        // Lưu các thay đổi
        $user->save();

        // Chuyển hướng về trang danh sách với thông báo thành công
        return redirect()->route('admin.users.index')->with('success', 'Cập nhật người dùng thành công.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Tìm user theo ID
        $user = User::findOrFail($id);

        // Xóa ảnh avatar nếu tồn tại
        if ($user->avatar) {
            $avatarPath = public_path($user->avatar); // Lấy đường dẫn ảnh
            if (file_exists($avatarPath)) {
                unlink($avatarPath); // Xóa ảnh avatar từ thư mục
            }
        }

        // Xóa user khỏi cơ sở dữ liệu
        $user->delete();

        // Chuyển hướng về trang danh sách với thông báo thành công
        return redirect()->route('admin.users.index')->with('success', 'Người dùng đã được xóa thành công.');
    }
}
