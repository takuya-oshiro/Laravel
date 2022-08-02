@extends('layouts.mypage_parent')

@section('content')

<div class="my_comment container">
  <h3>コメント一覧</h3>
  <p>-----------------------------</p>
  <?php $i = 0 ?>
  <?php foreach ($comments as $post) : ?>
    <div class=" part_post border border-dark mb-5" style="background-color:aquamarine ;">
      <div class="posts" style="background-color:azure ;">
        <p>コメントした投稿</p>
        <p class="title">タイトル:<h3> {{ $post->post_title }} </h3> </p><br>
        <div>内容 : {{ $post->post_content }}
          <span class="post_time"><?php echo $post->updated_at ?></span>
        </div><br>
      </div>

      <p>コメント</p>
      <?php foreach ($post->comments as $com) : ?>
        <div class="post_frame posts">

          <div>
            <p>内容：{{ $com->comment }} </p>
            <p>コメント時間：{{ $com->updated_at }} </p>
          </div>

          <div class="d-flex">

            <form action="{{ route('comment.edit',$com) }}">
              @csrf
              <input type="submit" value="編集">
            </form>

            <form action="{{ route('comment.delete',$com) }}" method="post">
              @csrf
              @method('DELETE')
              <input type="submit" value="削除">
            </form>
          </div>

        </div>
      <?php endforeach ?>
      {{ $comments->appends(request()->query())->links('pagination::bootstrap-4') }}
    </div>

    <?php ++$i ?>
  <?php endforeach ?>
</div>
</div>

@endsection