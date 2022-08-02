<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Requests\CommentUpdateRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
//use App\Models\Comment;

class MyPageController extends Controller
{

    /**
     * マイページの表示(投稿一覧)
     * @param Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public static function posts(Request $request)
    {
        $user_id = $request->session()->get('login_user')['id'];
        $posts = Post::where('user_id', $user_id)->with('user')->Paginate(5);
        return view('my_posts', compact('posts'));
    }

    /**
     * マイページの表示(コメント一覧)
     * @param Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function comments(Request $request)
    {
        $user_id = $request->session()->get('login_user')['id'];
        $comments = $this->Post->getCommentAndPost($user_id);
        return view('my_comments', compact('comments'));
    }


    public static function showUserUpdate()
    {
        $user = User::find(session()->get('login_user')['id']);
        return view('update_user', compact('user'));
    }

    /**
     * 投稿の削除
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
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
     * @param  correction $post
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function showEdit(Post $post)
    {
        return view('post_edit', compact('post'));
    }

    /**
     * 投稿を更新
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function update(Post $post, PostRequest $request)
    {
        if (session('login_user')->isNot($post->user)) {
            return back()->with('flash_message', '自分の投稿のみ編集可能です');
        }
        $data = $request->only('post_title', 'post_content');
        $post->update($data);
        return view('post_edit', compact('post'))->with('flash_message', '変更完了');
    }


    /**
     * コメント編集画面の表示
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function showCommentEdit(Comment $comment)
    {
        return view('comment_edit', compact('comment'));
    }


    /**
     * コメントの更新
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function commentUpdate(Comment $comment, CommentUpdateRequest $request)
    {
        if (session('login_user')->isNot($comment->user)) {
            return back()->with('flash_message', '自分のコメントのみ編集可能です');
        }
        $data = $request->only('comment');
        $comment->update($data);
        return view('comment_edit', compact('comment'))->with('flash_message', '変更完了');
    }


    /**
     * コメントの削除
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function commentDelete(Comment $comment)
    {
        if (session('login_user')->isNot($comment->user)) {
            return back()->with('flash_message', '自分のコメントのみ削除可能です');
        }
        $comment->delete($comment->id);
        return back();
    }
}
