@extends('layouts.parent')

@section('content')
  <br>
  {{ $post->name }}
  {{ $post->post_title }}
  {{ $post->post_content }}
  {{ $post->updated_at }}
  <br>
  <div>-----------------------------------</div>
  <div>
    <form action="/comment" method="POST">
      @csrf
      <textarea name="comment" cols="30" rows="3"></textarea><br>
      <input type="hidden" name="post_id" value="<?php echo $post['id'] ?>">
      <input type="submit" value="コメントする">
    </form>
  </div>

  @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif
  -----------------------------------<br>
  コメント一覧:
  <div>
    <?php foreach ($post->comments as $comments) : ?>
      {{ $comments->name }}
      {{ $comments->comment }}
      {{ $comments->created_at }}<br>
    <?php endforeach ?>
    <a href="/top">記事一覧へ</a>
  </div>
</body>

@endsection