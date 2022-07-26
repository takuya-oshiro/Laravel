<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginFormRequest;
use App\Models\User;
//use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * ログイン画面の表示
     * @return View
     */
    public function show()
    {
        return view('login');
    }

    /**
     * ログイン処理
     * @param App\Http\Requests\LoginFormRequest;
     * @return void
     */
    public function login(LoginFormRequest $request)
    {
        $user = new User();
        $data = $user::where('email', $request->email)->first();

        if (!$data) {
            return back()->withErrors([
                'login_error' => 'メールアドレスが登録されていません。'
            ]);
        }
        if(!password_verify($request->password, $data -> password)){
            return back()->withErrors([
                'login_error' => 'メールアドレスかパスワードが間違っています。'
            ]);
        }
        session()->put('login_user', $data);
        return redirect()->route('showTop');
    }
}
