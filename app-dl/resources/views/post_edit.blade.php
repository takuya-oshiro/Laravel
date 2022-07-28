@extends('layouts.parent')

@section('content')
<div class="text-center mt-3">

<div>
  <h4 class="mb-3">変更前</h4>
  <p>タイトル：{{ $post->post_title }}</p>
  <p>内容：{{ $post->post_content }}</p>
</div>

<div style="height:100px;">
<img class="h-100" src="{{ asset('/image/arrows-147753_640.png') }}" alt="矢印">
</div>

<form action="{{ route('post.update',$post) }}" method="post">
  @method ('PUT')
  @csrf
  <div>
    タイトル：<br>
    <input name="post_title" />
  </div>
  <div>
    内容:<br>
    <textarea name="post_content"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">送信</button>
</form>

<a href="{{ route('showMyPage') }}">記事一覧へ</a>

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

</div>

@endsection