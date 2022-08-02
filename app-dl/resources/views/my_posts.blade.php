@extends('layouts.mypage_parent')

@section('content')

<div>
  <h3>自分の投稿一覧</h3>
  <?php foreach ($posts as $post) : ?>
    <div class="post_frame" style="background-color:antiquewhite ;">

      <div class="">
        <h3>{{ Str::limit($post->post_title, 30) }}</h3>
        <p class="h6">{{ Str::limit($post->post_content, 30) }}</p>
        <small>
          <span>{{ $post->updated_at }}/</span>
          <span>投稿者：{{ $post->user->name }}</span>
        </small>
      </div>

      <div class="d-flex">

        <form action="{{ route('post.edit',$post) }}">
          @csrf
          <input type="submit" value="編集">
        </form>

        <form action="{{ route('post.delete',$post) }}" method="post">
          @csrf
          @method('DELETE')
          <input type="submit" value="削除">
        </form>
      </div>
    </div>
  <?php endforeach ?>
  {{ $posts->appends(request()->query())->links('pagination::bootstrap-4') }}
</div>
</div>

@endsection