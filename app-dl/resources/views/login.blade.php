@extends('layouts.parent')

@section('content')

<div class="text-center mt-5">
  <h2>ログイン</h2>
  @if (session('flash_message'))
  <div class="flash_message">
    {{ session('flash_message') }}
  </div>
  @endif

  @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif

  <form action="{{ route('login') }}" method="post">
    @csrf
    <p>Email :<input type="text" name="email"></p>
    <p>password:<input type="password" name="password"></p>
    <p><button>送信</button></p>
  </form>

  <a href="{{ route('showApply') }}">新規登録</a>

</div>
@endsection