@extends('layouts.parent')

@section('content')
<div class="text-center mt-4">
  <h2>新規登録画面</h2>
  <form action="{{ route('applyEmail') }}" method="post">
    @csrf
    <p>Email:<input type="text" name="email"></p>
    <p><input type="submit" value="送信"></p>
    @if ($errors->first('email'))
    <div>{{ $errors->first('email') }}</div>
    @endif


    @if (session('flash_error'))
    <div class="flash_message">
      {{ session('flash_error') }}
    </div>
    @endif
  </form>
</div>
@endsection