<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
//use App\Models\Comment;

class MyPageController extends Controller
{
    public static function show(Request $request)
    {
        $user_id = $request->session()->get('login_user')['id'];
        $my_posts = Post::where('user_id' , $user_id)->with('user')->get();
        $comments = Post::with('comments')->where('user_id' , $user_id)->get();
        return view('my_page',compact('my_posts', 'comments'));
    }

    public static function showUserUpdate()
    {
        return view('update_user_info');    
    }
}
