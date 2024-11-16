<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    const PATH_UPLOAD = 'images/categories';

    public function index()
    {
        $categories = Category::latest('id')->paginate(10);

        if ($categories->isEmpty()) {
            return $this->jsonResponse('Chưa có danh mục nào được tạo.', [], 404);
        }

        return $this->jsonResponse('Lấy danh sách danh mục thành công', $categories);

        // return $this->jsonResponse('Lấy danh sách danh mục thành công', [
        //     'data' => $categories->items(), 
        //     'pagination' => [
        //         'current_page' => $categories->currentPage(), 
        //         'last_page' => $categories->lastPage(),
        //         'per_page' => $categories->perPage(), 
        //         'total' => $categories->total(), 
        //     ]
        // ]);
    }

    public function create(StoreCategoryRequest $request)
    {
        $data = $request->validated();

        try {
            $data['slug'] = Str::slug($data['name']);
            $data['is_active'] = $data['is_active'] ?? 0;
            
            $count = Category::where('slug', $data['slug'])->count();
    
            if ($count > 0) {
                $data['slug'] = "{$data['slug']}-{$count}";
            }

            if ($request->hasFile('image')) {
                $data['image'] = Storage::put(self::PATH_UPLOAD, $request->file('image'));
            }

            Category::create($data);

            return $this->jsonResponse('Thêm danh mục thành công.', [], 201);
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return $this->jsonResponse('Thêm danh mục thất bại, vui lòng thử lại!', [], 500);
        }
    }
    
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->first();

        if (!$category) {
            return $this->jsonResponse('Không tìm tháy danh mục.', [], 404);
        }

        return $this->jsonResponse('Lấy thông tin danh mục thành công.', $category, 200);
    }

    public function update(UpdateCategoryRequest $request, $slug)
    {
        $category = Category::where('slug', $slug)->first();

        if (!$category) {
            return $this->jsonResponse('Không tìm tháy danh mục.', [], 404);
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

            return $this->jsonResponse('Cập nhật danh mục thành công.', [], 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());  

            return $this->jsonResponse('Cập nhật danh mục thất bại, vui lòng thử lại!', [], 500);
        }
    }

    public function delete($slug)
    {
        try {
            $category = Category::where('slug', $slug)->first();
    
            if (!$category) {
                return response()->json([
                    'message' => 'Không tìm thấy danh mục.',
                ], 404);
            }

            if ($category->posts->count() > 0) {
                return response()->json([
                    'message' => 'Danh mục này đang chứa bài viết, không thể xóa!',
                ], 400);
            }
    
            if ($category->image && Storage::exists($category->image)) {
                Storage::delete($category->image); 
            }

            $category->delete();
    
            return response()->json([
                'message' => 'Xóa danh mục thành công.',
            ], 200);
            
        } catch (\Exception $e) {
            Log::error($e->getMessage());
    
            return response()->json([
                'message' => 'Xóa danh mục thất bại, vui lòng thử lại!',
            ], 500);
        }
    }    

    private function jsonResponse($message, $data = [], $status = 200)
    {
        $response = [
            'message' => $message,
        ];

        if (!empty($data)) {
            $response['data'] = $data;
        }
        return response()->json($response, $status);
    }
}
