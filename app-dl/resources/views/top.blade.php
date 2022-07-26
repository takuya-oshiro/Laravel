@extends('layouts.parent')

@section('content')
<div class="frame">

  <header style="text-align:center;">
    <form action="{{ route('logout') }}" method="POST">
      @csrf
      <input type="submit" value="ログアウト">
    </form>
    <p>記事一覧</p>
  </header>
  <div class="contents">
    <div class="main">
      <div>
        <form action="{{ route('showTop') }}" method="GET">
          <input type="text" name="keyword" value="{{ $keyword }}">
          <input type="submit" value="検索">
        </form>
      </div>

      <?php foreach ($posts as $ans) : ?>
        <div class="post_frame">
          <div class="posts">
            <span class="title">タイトル : <?php echo $ans["post_title"], $ans->comments_count . '件のコメント' ?></span>
            <span class="name">投稿ユーザー：<?php echo $ans['name'] ?></span><br>
            <span class="post_time"><?php echo $ans['updated_at'] ?></span>
            <div>投稿内容 : <?php echo $ans['post_content'] ?></div>
          </div>

          <div class="post_ditail">
            <form action="{{ route('showDetail') }}" method="get">
              <input type="hidden" name="id" value="<?php echo $ans->id ?>">
              <input type="submit" value="詳細">
            </form>
            <br>
          </div>
        </div>
      <?php endforeach ?>

      <div class="d-flex p-2 bd-highlight">
        {{ $posts->appends(request()->query())->links('pagination::bootstrap-4') }}
      </div>
    </div>


    <div class="side">
      <div>
        <form action="{{ route('showMyPage') }}" method="get">
          @csrf
          <button style="width:100%; height:250px;" type="submit">マイページ</button>
        </form>
      </div>

      <div>
        <form action="{{ route('createPost') }}" method="get">
          @csrf
          <button style="width:100%; height:250px;" type="submit">新規投稿</button>
        </form>
      </div>


      <form class="form_wrap" action="AdminDataController.php" method="POST">
        @csrf
        <div class="csv_import_textarea">
          <input type="hidden" name="admin_top_trigger" value="1">
          <input style="width:100%; height:250px;" type="submit" value="csv">
          <div>
      </form>
    </div>
  </div>
  @endsection