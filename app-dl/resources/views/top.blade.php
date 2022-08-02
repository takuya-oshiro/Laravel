@extends('layouts.parent')

@section('content')
<div class="container">
  <div class="frame border border-dark mt-3">
    <div class="contents d-flex row">
      <div class="main w-75 col-8">
        <form class="input-group w-75 mx-auto mt-3" action="{{ route('showTop') }}" method="GET">
          <input class="form-control" type="text" name="keyword" value="{{ $keyword }}">
          <button class="btn btn-outline-success" type="submit">検索</button>
        </form>

        <?php foreach ($posts as $ans) : ?>
          <div class="post_frame">
            <a href="{{ route('showDetail',$ans) }}">
              <h4>{{ Str::limit($ans->post_title, 30) }}</h4>
            </a>
            <p class="h6">{{ Str::limit($ans->post_content, 30) }}</p>
            <small>
              <span>{{ $ans->updated_at }}/</span>
              <span>投稿者：{{ $ans->user->name }}/</span>
              <span>{{ $ans->comments_count }}件のコメント</span>
            </small>
          </div>
        <?php endforeach ?>
        <div class="d-flex p-2 bd-highlight">
          {{ $posts->appends(request()->query())->links('pagination::bootstrap-4') }}
        </div>
      </div>

      <div class="side w-25 col-4">
        <form action="{{ route('myPage.Posts') }}" method="get">
          @csrf
          <button style="width:100%; height:250px;" type="submit">マイページ</button>
        </form>

        <form action="{{ route('createPost') }}" method="get">
          @csrf
          <button style="width:100%; height:250px;" type="submit">新規投稿</button>
        </form>


        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button style="width:100%; height:250px;" type="submit">ログアウト</button>
        </form>
      </div>
    </div>
  </div>
  @endsection