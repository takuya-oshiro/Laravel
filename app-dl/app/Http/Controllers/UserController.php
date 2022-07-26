<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewEmailRequest;
use App\Models\Usertdb;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistraMail;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function applyEmail(NewEmailRequest $request)
    {
        $credentials = $request->only('email');
        $urltoken = hash('sha256', uniqid(rand(), 1));
        $credentials['urltoken'] = $urltoken;
        $Usertdb = new Usertdb();
        $Usertdb->insertTdbUser($credentials);
        $url = "http://localhost:28001/applycheck?urltoken=$urltoken";
        Mail::to($credentials['email'])->send(new RegistraMail($url));
        return redirect()->route('showLogin');
    }

    public function showApply()
    {
        return view('apply_email_form');
    }

    public function tokenCheck(Request $request)
    {
        $Usertdb = new Usertdb();
        $token = $Usertdb->Where('urltoken', $request['urltoken'])->get(['mail', 'created_at']);
        $start = Carbon::now()->subHour(24);
        $end = Carbon::now();
        $target = $token[0]->created_at;
        $result = $target->between($start, $end);
        if (!$result) {
            session()->flash('flash_message', '有効期限が切れています、もう一度登録し直して下さい');
            return view('apply_email_form');
        }
        session()->flash('flash_message', 'URLが確認されました。本登録を行って下さい');
        return view('register_form', ['email' => $token[0]->mail]);
    }

    public function registar(RegisterRequest $request)
    {
        $user = new User();
        $user->insert($request);
        session()->flash('flash_message', '本登録が完了しました。ログインを行って下さい');
        return view('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('showLogin');
    }

    public function update(UserUpdateRequest $request)
    {
        $user = User::find($request->session()->get('login_user')['id']);
        $user->name = $request->nickname;
        $user->password = Hash::make($request->password);
        $user->update();
        return back();
    }
}
