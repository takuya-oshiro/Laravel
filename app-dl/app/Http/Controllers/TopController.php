<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;

class TopController extends Controller
{
    /**
     * トップ画面の表示
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show(Request $request)
    {
        $keyword = $request->input('keyword');
        $query = Post::query();
        if (!empty($keyword)) {
            $query
                ->where('post_title', 'LIKE', "%{$keyword}%")
                ->orWhere('post_content', 'LIKE', "%{$keyword}%");
        }
        $posts = $query
                    ->with('user')
                    ->withCount('comments')
                    ->latest('updated_at')
                    ->Paginate(5);
        return view('top', compact('posts','keyword'));
    }

    /**
     * 詳細画面の表示
     *
     * @param Post postデータ
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function detail(Post $post)
    {
        return view('post_detail', compact('post'));
    }

}
