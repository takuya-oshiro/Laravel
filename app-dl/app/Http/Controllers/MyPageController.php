<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
//use App\Http\Requests\CommentRequest;
use App\Http\Requests\CommentUpdateRequest;
use App\Models\Comment;
use App\Models\Post;
//use App\Models\Comment;

class MyPageController extends Controller
{
    /**
     * マイページの表示
     * @param Request $request
     * @return view
     */
    public static function show(Request $request)
    {
        $user_id = $request->session()->get('login_user')['id'];
        $my_posts = Post::where('user_id', $user_id)->with('user')->get();
        $Post = new Post();
        $comments = $Post->getCommentAndPost($user_id);
        return view('my_page', compact('my_posts', 'comments'));
    }


    public static function showUserUpdate()
    {
        return view('update_user_info');
    }


    /**
     * 投稿の削除
     * @return view
     */
    public function delete(Post $post)
    {
        if (session('login_user')->isNot($post->user)) {
            return back()->with('flash_message', '自分の投稿のみ削除可能です');
        }
        $post->delete($post->id);
        return back();
    }


    /**
     * 投稿編集画面の表示
     * @return view
     */
    public function showEdit(Post $post)
    {
        return view('post_edit', compact('post'));
    }


    /**
     * 投稿編集画面の表示
     * @return view
     */
    public function update(Post $post,PostRequest $request)
    {
        if(session('login_user')->isNot($post->user)){
            return back()->with('flash_message', '自分の投稿のみ編集可能です');
        }
        $data = $request->only('post_title','post_content');
        $post->update($data);
        return view('post_edit', compact('post'))->with('flash_message', '変更完了');
    }


    /**
     * コメント編集画面の表示
     * @return view
     */
    public function showCommentEdit(Comment $comment)
    {
        return view('comment_edit', compact('comment'));
    }


    /**
     * コメントの更新
     * @return view
     */
    public function commentUpdate(Comment $comment,CommentUpdateRequest $request)
    {
        if(session('login_user')->isNot($comment->user)){
            return back()->with('flash_message', '自分のコメントのみ編集可能です');
        }
        $data = $request->only('comment');
        $comment->update($data);
        return view('comment_edit', compact('comment'))->with('flash_message', '変更完了');
    }


    /**
     * コメントの削除
     * @return view
     */
    public function commentDelete(CommentUpdateRequest $comment)
    {
        if (session('login_user')->isNot($comment->user)) {
            return back()->with('flash_message', '自分のコメントのみ削除可能です');
        }
        $comment->delete($comment->id);
        return back();
    }
    
}
