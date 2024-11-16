<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->has('query')) {
            // Lọc bài viết theo id (query)
            $postId = $request->query('query');
            $posts = Post::with(['category', 'user'])
                        ->where('id', $postId)
                        ->orderBy('created_at', 'desc')
                        ->paginate(20);
        } else {
            // Nếu không có query, lấy tất cả bài viết
            $posts = Post::with(['category', 'user'])
                        ->orderBy('created_at', 'desc')
                        ->paginate(20);
        }
    
        // Trả về view với dữ liệu
        return view('admin.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $users = User::all();
        return view('admin.post.create', compact('categories', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(StorePostRequest $request)
    {
        $request->validated();

        // Initialize a new Post instance
        $post = new Post();
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->description = $request->description;
        $post->content = $request->content;
        $post->category_id = $request->category_id;
        $post->user_id = $request->user_id;
        $post->is_active = $request->is_active;
        $post->view = 0;

        // Handle image upload and store the path
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/images', $filename, 'public');
            $post->image = $filePath; // Save the image path in the database
        }

        $post->save();

        return redirect()->route('admin.posts.index')->with('success', 'Bài viết đã được thêm thành công.');
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;
    
            $path = $request->file('upload')->storeAs('images/posts', $fileName, 'public');
    
            $url = Storage::url($path);
            return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        $users = User::all();
        return view('admin.post.edit', compact('post', 'categories', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, $id)
    {
        $post = Post::findOrFail($id);

        $request->validated();

        // Xử lý ảnh mới nếu có
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ
            Storage::delete($post->image);

            // Lưu ảnh mới
            $imagePath = $request->file('image')->store('public/images');
            $post->image = Storage::url($imagePath);
        }

        // Cập nhật dữ liệu bài viết
        $post->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'category_id' => $request->category_id,
            'user_id' => $request->user_id,
            'content' => $request->content,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('admin.posts.index')->with('success', 'Bài viết đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        // Xóa ảnh nếu có
        if ($post->image) {
            Storage::delete($post->image);
        }

        // Xóa bài viết
        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Bài viết đã được xóa thành công.');
    }
}
