@extends('layouts.parent')

@section('content')
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
  <p>Email：<input type="text" name="email" value="{{ session('login_user')->email }}" readonly>
  <p>ニックネーム：<input type="text" name="nickname" value=""></p>
  <p>パスワード：<input type="password" name="password" value=""></p>
  <p>パスワード(再)：<input type="password" name="password_confirmation" value=""></p>
  <p><input type="submit" value="決定"></p>

</form>
<a href="{{ route('showMyPage') }}">マイページへ</a>
@endsection