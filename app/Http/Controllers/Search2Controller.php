<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class Search2Controller extends Controller
{
    public function search(Request $request)
    {
        $data = $request->input('search');
        $category = $request->input('category');
        $sortBy = $request->input('sort_by');

        $searchResultsQuery = Post::where('title', 'like', '%' . $data . '%')
            ->orWhere('description', 'like', '%' . $data . '%');


        if ($category) {
            $searchResultsQuery->where('category_id', $category);
        }

        if ($sortBy == 'newest') {
            $searchResultsQuery->orderBy('created_at', 'desc');
        } elseif ($sortBy == 'oldest') {
            $searchResultsQuery->orderBy('created_at', 'asc');
        }

        $searchResults = $searchResultsQuery->paginate(10);

        return view(
            'clients.shearch',
            [
                'searchResults' => $searchResults,
                'searchQuery' => $data,
                'categories' => Category::all(),
                'sortBy' => $sortBy
            ]
        );
    }
}