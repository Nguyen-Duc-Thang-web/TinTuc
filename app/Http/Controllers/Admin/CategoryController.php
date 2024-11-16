<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;


class CategoryController extends Controller
{
    const PATH_VIEW = 'admin.categories.';
    const PATH_UPLOAD = 'images/categories';

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Lấy danh sách các category mới nhất với phân trang
        $categories = Category::latest('id')->paginate(10);

        // Kiểm tra nếu có tham số tìm kiếm 'query'
        if ($request->has('query')) {
            // Lấy giá trị từ tham số 'query' và dùng nó để lọc category theo id
            $userId = $request->query('query');  // Lấy giá trị của 'query' từ request
            // Tìm các category có id tương ứng với giá trị 'query'
            $categories = Category::where('id', $userId)->paginate(10); // Phân trang 10 kết quả
        }

        // Trả về view với dữ liệu categories
        return view(self::PATH_VIEW . __FUNCTION__, compact('categories'));
    }

    
    public function show($slug)
    {
        // Lấy danh mục theo slug
        $category = Category::where('slug', $slug)->firstOrFail();

        // Lấy các bài viết thuộc danh mục này
        $posts = Post::where('category_id', $category->id)
                     ->where('is_active', 1)
                     ->get();

        return view('clients.category', compact('category', 'posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $data = $request->validated();

        try {
            $data['slug'] = Str::slug($data['name']);
            $data['is_active'] = $request->input('is_active', 0);
    
            $count = Category::where('slug', $data['slug'])->count();
    
            if ($count > 0) {
                $data['slug'] = "{$data['slug']}-{$count}";
            }
    
            if ($request->hasFile('image')) {
                $data['image'] = Storage::put(self::PATH_UPLOAD, $request->file('image'));
            }
    
            Category::create($data);
    
            return redirect()->route('admin.categories.index')->with('success', 'Thêm danh mục thành công!');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            
            return back()->with('error', 'Thêm danh mục thất bại, vui lòng thử lại!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $category = Category::where('slug', $slug)->first();

        if (!$category) {
            return back()->with('error', 'Không tìm thấy danh mục!');
        }

        return view(self::PATH_VIEW . __FUNCTION__, compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, $slug)
    {
        $category = Category::where('slug', $slug)->first();

        if (!$category) {
            return back()->with('error', 'Không tìm thấy danh mục!');
        }

        try {

            $data = $request->validated();

            $data['slug'] = Str::slug($data['name']);
            $data['is_active'] = $request->input('is_active', 0);
  
            $old_image = $category->image;
            if ($request->hasFile('image')) {
                $data['image'] = Storage::put(self::PATH_UPLOAD, $request->file('image'));

                if ($old_image && Storage::exists($old_image)) {
                    Storage::delete($old_image);
                }
            }
             
            $category->update($data);

            return redirect()->route('admin.categories.edit', ['slug' => $data['slug']])->with('success', 'Cập nhật danh mục thành công!');
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return back()->with('error', 'Cập nhật danh mục thất bại, vui lòng thử lại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        $category = Category::where('slug', $slug)->first();

        if (!$category) {
            return back()->with('error', 'Không tìm thấy danh mục!');
        }

        try {
            if ($category->posts->count() > 0) {
                return back()->with('error', 'Danh mục này đang chứa bài viết, không thể xóa!');
            } 
            if ($category->image && Storage::exists($category->image)) {
                Storage::delete($category->image); 
            }

            $category->delete();

            return back()->with('success', 'Xóa danh mục thành công!');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            
            return back()->with('error', 'Xóa danh mục thất bại, vui lòng thử lại!');
        }
    }
}
