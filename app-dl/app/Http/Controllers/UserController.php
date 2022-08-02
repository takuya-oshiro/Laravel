<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Traits\Checkable;

class UserController extends Controller
{
    use Checkable;
    /**
     * 新規登録画面の表示
     * @return view
     */
    public function showApply()
    {
        return view('apply_email_form');
    }

    /**
     * 本登録処理「
     * @param RegisterRequest $request
     * @return view
     */
    public function registar(RegisterRequest $request)
    {
        $this->User->insert($request);
        session()->flash('flash_message', '本登録が完了しました。ログインを行って下さい');
        return view('login');
    }

    /**
     * ログアウト処理
     * @param Request $request
     * @return view
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('showLogin');
    }

    /**
     * ユーザー情報アップデート処理
     * @param UserUpdateRequest $request
     * @return view
     */
    public function update(UserUpdateRequest $request)
    {
        $password = Hash::make($request->password);
        $user = User::find($request->session()->get('login_user')['id']);
        $user->update(['name' => $request->nickname, 'password' => $password]);
        return view('update_user' ,compact('user'));
    }
}
