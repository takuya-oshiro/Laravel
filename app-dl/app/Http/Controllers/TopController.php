<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;

class TopController extends Controller
{
    public function show(Request $request)
    {
        $keyword = $request->input('keyword');
        $query = Post::query();
        if (!empty($keyword)) {
            $query->where('post_title', 'LIKE', "%{$keyword}%")
                ->orWhere('post_content', 'LIKE', "%{$keyword}%");
        }
        $posts = $query->withCount('comments')->latest('updated_at')->Paginate(5);
        return view('top', compact('posts','keyword'));
    }

    public function detail(Request $request)
    {
        $id = $request->input('id');
        $detail = Post::with('comments')->find($id);
        return view('post_detail', compact('detail'));
    }
}
