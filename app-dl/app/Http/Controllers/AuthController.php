<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\RegistraMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Http\Requests\NewEmailRequest;
use App\Http\Requests\LoginFormRequest;
use Carbon\Carbon;
use App\Traits\Checkable;

class AuthController extends Controller
{
    use Checkable;

    /**
     * ログイン画面の表示
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show()
    {
        return view('login');
    }

    /**
     * ログイン処理
     * @param App\Http\Requests\LoginFormRequest;
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function login(LoginFormRequest $request)
    {
        $data = $this->User::where('email', $request->email)->first();

        if (!$data) {
            return back()->withErrors([
                'login_error' => 'メールアドレスが登録されていません。'
            ]);
        }
        if (!password_verify($request->password, $data->password)) {
            return back()->withErrors([
                'login_error' => 'メールアドレスかパスワードが間違っています。'
            ]);
        }
        session()->put('login_user', $data);
        return redirect()->route('showTop');
    }

    /**
     * 新規登録用メールアドレスが入力された時の処理
     * @param NewEmailRequest $request
     * @return void
     */
    public function applyEmail(NewEmailRequest $request)
    {
        $email = Checkable::Checkable($request['email']);
        if (!$email) {
            return back();
        }
        $token = hash('sha256', uniqid(rand(), 1));
        $this->Usertdb->insertTdbUser($request['email'], $token);
        $url = "http://localhost:28001/applycheck?urltoken={$token}";
        Mail::to($request['email'])->send(new RegistraMail($url));
        return redirect()->route('showLogin');
    }

    /**
     * トークンの確認
     * @param Request $request
     * @return void
     */
    public function tokenCheck(Request $request)
    {
        $token = $this->Usertdb->Where('urltoken', $request['urltoken'])->get(['mail', 'created_at']);
        $email = Checkable::Checkable($token[0]->mail);
        if (!$email) {
            return view('apply_email_form');
        }
        $target = $token[0]->created_at;
        $result = $target->between(Carbon::now()->subHour(24), Carbon::now());
        if (!$result) {
            session()->flash('flash_message', '有効期限が切れています、もう一度登録し直して下さい');
            return view('apply_email_form');
        }
        session()->flash('flash_message', 'URLが確認されました。本登録を行って下さい');
        return view('register_form', ['email' => $token[0]->mail]);
    }
}
