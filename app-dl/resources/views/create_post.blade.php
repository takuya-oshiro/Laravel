@extends('layouts.parent')

@section('content')

@if ($errors->any())
<div class="alert alert-danger">
<ul>
  @foreach ($errors->all() as $error)
  <li>{{ $error }}</li>
  @endforeach
</ul>
</div>
@endif

<form action="{{ route('insertPost') }}" method="post">
    @csrf
    <div>
        タイトル：
        <input name="post_title" />
    </div>
    <div>
        内容:
        <textarea name="post_content"></textarea>
    </div>
    <button>送信</button>
</form>

<a href="{{ route('showTop') }}">記事一覧へ</a>
@endsection