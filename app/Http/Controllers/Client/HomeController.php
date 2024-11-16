<?php

namespace App\Http\Controllers\Client;

use Carbon\Carbon;
use App\Models\Faq;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\Category;
use App\Models\ReadHistory;
use Illuminate\Http\Request;
use App\Models\Advertisement;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function index()
    {
        $now = Carbon::now()->toDateTimeString();
        $weekAgo = Carbon::now()->subWeek()->toDateTimeString();

        $latestPosts = Post::latest('id')->paginate(10);

        $trendingPosts = Post::whereBetween('created_at', [$weekAgo, $now])
            ->orderByDesc('view')
            ->paginate(10);

        $postsInWeek = Post::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()])
            ->orderBy('created_at', 'desc')
            ->limit(9)
            ->get();

        return view('clients.home', compact('latestPosts', 'trendingPosts', 'postsInWeek'));
    }

    public function contactPage()
    {
        return view('clients.contact');
    }

    public function categories()
    {
        $categories = Category::where('is_active', true)->get();

        return $categories;
    }

    public function findPostByCategory($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $categoryPosts = $category->posts()->latest('id')->paginate(20);

        if (Auth::check() && Auth::user()->member() == 'member') {
            $category->increment('click_count');
        }

        return view('clients.category', compact('category', 'categoryPosts'));
    }

    public function postDetail($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        $relatedPosts = Post::where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->latest('id')
            ->limit(3)
            ->get();

        $post->increment('view');

        $comments = Comment::where('post_id', $post->id)->latest()->take(3)->get();

        if (Auth::check()) {
            $userId = Auth::id();
            $history = ReadHistory::where('user_id', $userId)
                ->where('post_id', $post->id)
                ->first();

            if (!$history) {
                ReadHistory::create([
                    'user_id' => $userId,
                    'post_id' => $post->id,
                    'read_at' => Carbon::now(),
                ]);
            }
        }

        return view('clients.post-detail', compact('post', 'relatedPosts', 'comments'));
    }

    public function featuredPosts()
    {
        $featuredPosts = Post::orderByDesc('view')->get();

        return $featuredPosts;
    }

    public function advertisement()
    {
        $now = Carbon::now()->toDateTimeString();

        $advertisement = Advertisement::where('status', 'active')
            ->whereDate('start_date', '<=', $now)
            ->whereDate('end_date', '>=', $now)
            ->get();

        return $advertisement;
    }

    public function faqs()
    {
        $faqs = Faq::latest('id')->paginate(10);

        return view('clients.faq', compact('faqs'));
    }

    public function submitContact(Request $request)
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

        return view('clients.contact')->with('success', 'Gửi liên hệ thành công.');
    }

    public function profile()
    {
        $user = Auth::user();

        return view('clients.users-profile', ['user' => $user]);
    }

    // public function edit()
    // {
    //     $user = Auth::user();  // Lấy người dùng đang đăng nhập
    //     return view('profile', compact('user'));  // Truyền dữ liệu người dùng vào view
    // }

    // Xử lý cập nhật thông tin người dùng
    public function update(Request $request)
    {
        // dd($request);
        $user = Auth::user();
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'avetar' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Xử lý ảnh hồ sơ (nếu có)
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/avatars', $filename, 'public');
            $user->avatar = '/storage/' . $filePath; // Lưu đường dẫn avatar vào database
        }

        $user->save();

        return redirect()->route('home/profile')->with('success', 'Cập nhật thông tin thành công.');
    }

    public function updatePassword(Request $request)
    {

        $user = Auth::user();  // Lấy thông tin người dùng hiện tại

        // Validate dữ liệu đầu vào
        $request->validate([
            'currentPassword' => 'required|string',  // Mật khẩu hiện tại
            'newPassword' => 'required|string|min:8|confirmed',  // Mật khẩu mới phải dài ít nhất 8 ký tự và phải có trường xác nhận
        ]);

        // Kiểm tra mật khẩu hiện tại có đúng không
        if (!Hash::check($request->currentPassword, $user->password)) {
            return redirect()->back()->withErrors(['currentPassword' => 'Mật khẩu hiện tại không đúng.']);
        }

        // Cập nhật mật khẩu mới
        $user->password = Hash::make($request->newPassword);
        // Mã hóa mật khẩu mới

        $user->save();

        // Trả về thông báo thành công
        return redirect()->route('home/profile')->with('success', 'Đổi mật khẩu thành công.')->withInput();
    }
    public function getNotifications()
    {
        try {
            // Lấy các bài viết được tạo trong 24 giờ qua
            $newArticles = Post::orderBy('id', 'desc')->limit(5)->get();


            if ($newArticles->isEmpty()) {
                return response()->json(['message' => 'Không có bài viết mới'], 200); // Trả về thông báo nếu không có bài viết mới
            }

            // Xử lý thông báo
            $notifications = $newArticles->map(function ($article) {
                $imageUrl = $article->image ? asset('storage/' . $article->image) : asset('template/admin/assets/img/default-image.jpg');
            
                return [

                    'title' => $article->title,
                    'link' => route('post-detail', $article->slug),
                    'image' => $imageUrl,
                ];
            });

            return response()->json(['notifications' => $notifications]);
        } catch (\Exception $e) {
            // Log lỗi nếu có và trả về lỗi 500
            \Log::error("Lỗi khi lấy thông báo: " . $e->getMessage());
            return response()->json(['error' => 'Không thể lấy thông báo.'], 500);
        }
    }
}
