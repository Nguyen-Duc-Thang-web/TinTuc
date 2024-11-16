<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdvertisementRequest;
use App\Http\Requests\UpdateAdvertisementRequest;
use App\Models\Advertisement;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AdvertisementController extends Controller
{
    const PATH_UPLOAD = 'images/advertisements';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $advertisements = Advertisement::latest('id')->paginate(10);

        if ($advertisements->isEmpty()) {
            return $this->jsonResponse('Chưa có quảng cáo nào được tạo.', [], 404);
        }

        return $this->jsonResponse('Lấy danh sách quảng cáo thành công.', $advertisements, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create(StoreAdvertisementRequest $request)
    {
        try {
            $data = $request->validated();

            if ($data['pages'] != 'home' && $data['position'] == 'header') {
                return $this->jsonResponse('Không hiển thị quảng cáo nào cho vị trí này ngoài trang chủ.', [], 400);
            }

            if ($this->checkDuplicateAdvertisement($data['pages'], $data['position'], $data['start_date'], $data['end_date'])) {
                return $this->jsonResponse('Đã có quảng cáo tồn tại trong khoảng thời gian hoặc vị trí này.', [], 400);
            }

            if ($request->hasFile('image')) {
                $data['image'] = Storage::put(self::PATH_UPLOAD, $request->file('image'));
            }

            Advertisement::create($data);

            return $this->jsonResponse('Thêm quảng cáo thành công.', [], 201);
        } catch (\Exception $e) {
            Log::error($e->getMessage());  
            
            if (isset($data['image']) && Storage::exists($data['image'])) {
                Storage::delete($data['image']);
            }

            return $this->jsonResponse('Thêm quảng cáo thất bại, vui lòng thử lại!', [], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $advertisement = Advertisement::find($id);

        if (empty($advertisement)) {
            return $this->jsonResponse('Không tìm thấy quảng cáo.', [], 404);
        }

        return $this->jsonResponse('Lấy thông tin quảng cáo thành công.', $advertisement, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdvertisementRequest $request, $id)
    {
        try {
            $advertisement = Advertisement::find($id);

            if (empty($advertisement)) {
                return $this->jsonResponse('Không tìm thấy quảng cáo.', [], 404);
            }

            $data = $request->validated();

            if ($data['pages'] != 'home' && $data['position'] == 'header') {
                return $this->jsonResponse('Không hiển thị quảng cáo nào cho vị trí này ngoài trang chủ.', [], 400);
            }
            
            if ($this->checkDuplicateAdvertisement($data['pages'], $data['position'], $data['start_date'], $data['end_date'], $advertisement->id)) {
                return $this->jsonResponse('Đã có quảng cáo tồn tại trong khoảng thời gian hoặc vị trí này!', [], 400);
            }

            $oldImage = $advertisement->image;

            if ($request->hasFile('image')) {
                $data['image'] = Storage::put(self::PATH_UPLOAD, $request->file('image'));

                if ($oldImage && Storage::exists($oldImage)) {
                    Storage::delete($oldImage);
                }
            }

            $advertisement->update($data);

            return $this->jsonResponse('Cập nhật quảng cáo thành công.', [], 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());  
            
            if (isset($data['image']) && Storage::exists($data['image'])) {
                Storage::delete($data['image']);
            }
            return $this->jsonResponse('Cập nhật quảng cáo thất bại, vui lòng thử lại!', [], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        try {
            $advertisement = Advertisement::find($id);

            if (empty($advertisement)) {
                return $this->jsonResponse('Không tìm thấy quảng cáo.', [], 404);
            }

            if ($advertisement->status === 'active') {
                return $this->jsonResponse('Không thể xóa quảng cáo đang hoạt động!', [], 400);
            }
            $advertisement->delete();

            return $this->jsonResponse('Xóa quảng cáo thành công.', [], 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());  

            return $this->jsonResponse('Xóa quảng cáo thất bại, vui lòng thử lại!', [], 500);
        }
    }

    public function trashed() 
    {
        try {
            $trashedAdvertisements = Advertisement::onlyTrashed()->orderBy('deleted_at', 'desc')->paginate(10);

            if ($trashedAdvertisements->isEmpty()) {
                return $this->jsonResponse('Chưa có quảng cáo nào bị xóa.', [], 404);
            }
        
            return $this->jsonResponse('Lấy danh sách quảng cáo trong thùng rác thành công.', $trashedAdvertisements, 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());  

            return $this->jsonResponse('Lấy danh sách quảng cáo trong thùng rác thất bại, vui lòng thử lại!', [], 500);
        }
    }

    public function restore ($id) 
    {
        try {
            $advertisement = Advertisement::withTrashed()->find($id);

            if (empty($advertisement)) {
                return $this->jsonResponse('Quảng cáo cần khôi phục không tồn tại!', [], 404);
            }

            $advertisement->restore();

            return $this->jsonResponse('Khôi phục quảng cáo thành công.', [], 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());  

            return $this->jsonReponse('Khôi phục quảng cáo thất bại, vui lòng thử lại!', [], 500);
        }
    }

    public function forceDelete ($id) 
    {
        try {
            $advertisement = Advertisement::withTrashed()->find($id);

            if (empty($advertisement)) {
                return $this->jsonResponse('Quảng cáo cần xóa vính viễn không tồn tại!', [], 404);
            }

            $advertisement->forceDelete();
            
            if ($advertisement->image && Storage::exists($advertisement->image)) {
                Storage::delete($advertisement->image); 
            }
            
            return $this->jsonResponse('Xóa quảng cáo vĩnh viễn thành công.', [], 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());  

            return $this->jsonReponse('Xóa quảng cáo vĩnh viễn thất bại, vui lòng thử lại!', [], 500);
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
    
    private function checkDuplicateAdvertisement($pages, $position, $startDate, $endDate, $currentId = null)
    {
        return Advertisement::where('pages', $pages)->where('position', $position)
            ->where(function($query) use ($startDate, $endDate) {
                $query->whereBetween('start_date', [$startDate, $endDate])
                    ->orWhereBetween('end_date', [$startDate, $endDate])
                    ->orWhere(function($query) use ($startDate, $endDate) {
                        $query->where('start_date', '<=', $startDate)
                            ->where('end_date', '>=', $endDate);
                    });
            })
            ->when($currentId, function($query) use ($currentId) {
                return $query->where('id', '!=', $currentId);
            })
            ->exists();
    }
}
