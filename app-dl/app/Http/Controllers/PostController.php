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
     * @return view
     */
    public function create()
    {
        return view('create_post');
    }

    /**
     * 投稿処理
     * @param PostRequest $request
     * @return view
     */
    public function insert(PostRequest $request)
    {
        $id = $request->session()->get('login_user')['id'];
        $post = new Post;
        $attributes = $request->only(['post_title', 'post_content']);
        $post->insert($attributes, $id);
        return redirect()->route('showTop');
    }

    /**
     * コメント処理
     * @param CommentRequest $request
     * @return void
     */
    public function commentInsert(CommentRequest $request)
    {
        $post_id = (int)$request->post_id;
        $user_id = $request->session()->get('login_user')['id'];
        $comment = $request->comment;
        $commentmodel = new Comment();
        $commentmodel->insert($user_id, $post_id, $comment);
        return back();
    }

    /**
     * 投稿編集画面の表示
     *
     * @return view
     */
    public function showEdit(Post $post)
    {
        return view('post_edit', compact('post'));
    }

    /**
     * 投稿編集画面の表示
     *
     * @return view
     */
    public function update(Post $post,PostRequest $request)
    {
        if(session('login_user')->isNot($post->user)){
            return back()->with('flash_message', '自分の投稿のみ編集可能です');
        }
        $data = $request->only('post_title','post_content');
        $post->update($data);
        return view('post_edit', compact('post'));
    }
}
