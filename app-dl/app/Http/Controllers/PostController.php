<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\PostRequest;
use App\Models\Comment;
use GuzzleHttp\Psr7\Request;

class PostController extends Controller
{
    
    /**
     * 投稿一覧表示
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create()
    {
        return view('create_post');
    }

    /**
     * 投稿処理
     * @param PostRequest $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function insert(PostRequest $request)
    {
        $id = $request->session()->get('login_user')['id'];
        $attributes = $request->only(['post_title', 'post_content']);
        $this->Post->insert($attributes, $id);
        return redirect()->route('showTop');
    }

    /**
     * コメント処理
     * @param CommentRequest $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function commentInsert(CommentRequest $request)
    {
        $post_id = (int)$request->post_id;
        $user_id = $request->session()->get('login_user')['id'];
        $request = $request->only('comment');
        $this->Comment->insert($user_id, $post_id, $request['comment']);
        return back();
    }
}
