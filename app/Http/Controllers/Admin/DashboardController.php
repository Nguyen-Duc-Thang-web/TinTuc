<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index($timeframe = null)
    {
        if ($timeframe != null) {
            switch ($timeframe) {
                case 'today':
                    $posts = Post::whereDate('created_at', Carbon::today())
                        ->orderBy('created_at', 'desc')
                        ->limit(10)
                        ->get();
                    if ($posts->count() == 0) {
                        redirect()->back()->with('message', 'Chưa có bài viết nào được tạo trong ngày hôm nay.');
                        break;
                    }
                    break;

                case 'week':
                    $posts = Post::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()])
                        ->orderBy('created_at', 'desc')
                        ->limit(10)
                        ->get();
                    if ($posts->count() == 0) {
                        redirect()->back()->with('message', 'Chưa có bài viết nào được tạo trong tuần này.');
                    }
                    break;

                case 'month':
                    $posts = Post::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()])
                        ->orderBy('created_at', 'desc')
                        ->limit(10)
                        ->get();
                    if ($posts->count() == 0) {
                        redirect()->back()->with('message', 'Chưa có bài viết nào được tạo trong tháng này.');
                    }
                    break;

                case 'year':
                    $posts = Post::whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()])
                        ->orderBy('created_at', 'desc')
                        ->limit(10)
                        ->get();
                    if ($posts->count() == 0) {
                        redirect()->back()->with('message', 'Chưa có bài viết nào được tạo trong năm nay.');
                    }
                    break;

                default:
                    $posts = Post::where('created_at', Carbon::today())
                        ->orderBy('created_at', 'desc')
                        ->limit(10)
                        ->get();
                    if ($posts->count() == 0) {
                        redirect()->back()->with('message', 'Chưa có bài viết nào được tạo trong ngày hôm nay.');
                        break;
                    }
                    break;
            }
            return view('admin.dashboard', compact('posts'));
        }

        $latestPosts = Post::where('is_active', true)->latest('id')->limit(10)->get();
        
        $postsToday = Post::whereDate('created_at', Carbon::today())
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        $postsMostViewed = Post::orderBy('view', 'desc')
            ->limit(10)
            ->get();

        $mostVisitedCategories = Category::where('is_active', true)
            ->orderBy('click_count', 'desc')
            ->limit(10)
            ->get();

        $countPostsInCategory = Category::where('is_active', true)
            ->select('id', 'name')
            ->withCount('posts')
            ->get();

        return view('admin.dashboard', compact('latestPosts', 'postsToday', 'postsMostViewed', 'mostVisitedCategories', 'countPostsInCategory'));
    }

}
