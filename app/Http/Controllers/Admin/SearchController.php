<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Models\Advertisement;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\FailedJob;
use App\Models\Faq;
use App\Models\Migration;
use App\Models\PasswordResetToken;
use App\Models\PersonalAccessToken;
use App\Models\Post;
use App\Models\ReadHistory;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Tìm kiếm trong bảng advertisements
        $advertisements = Advertisement::where('content', 'like', '%' . $query . '%')->get();

        // Tìm kiếm trong bảng categories
        $categories = Category::where('name', 'like', '%' . $query . '%')->get();

        // Tìm kiếm trong bảng comments
        $comments = Comment::whereHas('user', function($queryBuilder) use ($query) {
            $queryBuilder->where('name', 'like', '%' . $query . '%');
        })->get();
        // Tìm kiếm trong bảng contacts
        $contacts = Contact::where('name', 'like', '%' . $query . '%')
        ->orWhere('email', 'like', '%' . $query . '%')
        ->get();
        // Tìm kiếm trong bảng faqs
        $faqs = Faq::where('question', 'like', '%' . $query . '%')
                    ->orWhere('answer', 'like', '%' . $query . '%')
                    ->get();
        // Tìm kiếm trong bảng posts
        $posts = Post::where('title', 'like', '%' . $query . '%')
                    ->get();

        // Tìm kiếm trong bảng roles
        $roles = Role::where('name', 'like', '%' . $query . '%')->get();
        // Tìm kiếm trong bảng users
        $users = User::where('name', 'like', '%' . $query . '%')
                     ->orWhere('email', 'like', '%' . $query . '%')
                     ->get();
        // Trả kết quả tìm kiếm về view
        return view('admin.search-results', compact(
            'advertisements', 'categories', 'comments', 'contacts', 'faqs',
               'posts', 'roles', 'users'
        ));
    }
}
