@extends('layouts.parent')
@section('content')

<div class="text-center mt-3">
  <h2>ユーザー情報変更画面</h2>

  @foreach ($errors->all() as $error)
  <li>{{$error}}</li>
  @endforeach

  @if (session('flash_message'))
  <div class="flash_message">
    {{ session('flash_message') }}
  </div>
  @endif

  <form action="{{ route('updateUser') }}" method="post">
    <input type="hidden" name="_method" value="PUT">

    @csrf
    <p>Email：<input type="text" name="email" value="{{ $user->email }}" readonly>
    <p>現在のニックネーム：<input type="text" name="" value="{{ $user->name }}" readonly>
    <p>変更後のニックネーム：<input type="text" name="nickname" value=""></p>
    <p>パスワード：<input type="password" name="password" value=""></p>
    <p>パスワード(再)：<input type="password" name="password_confirmation" value=""></p>
    <p><input type="submit" value="決定"></p>

  </form>
  <a href="{{ route('myPage.Posts') }}">投稿一覧へ</a>
</div>
@endsection