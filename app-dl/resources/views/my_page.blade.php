<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/top.css" type="text/css">
  <title>記事一覧</title>
</head>

<body>

  <div class="frame">

    <header style="text-align:center;">
      <p>マイページ</p>
    </header>

    <nav>
      <a href="{{ route('showUserUpdate') }}">ユーザー情報変更</a>
    </nav>

    <p><a href=""> <button>コメント一覧</button> </a></p>


    <div class="post">
      <h3>自分の投稿</h3>
      <?php foreach ($my_posts as $ans) : ?>
        <div class="post_frame">

          <div class="posts">
            <span class="name">ユーザー名: <?php echo $ans->name ?></span>
            <span class="title">タイトル : <?php echo $ans->post_title ?></span><br>
            <span class="post_time"><?php echo $ans->updated_at ?></span>
            <div>投稿内容 : <?php echo $ans->post_content ?></div>
          </div>

          <div>

            <form action="{{ route('post.edit',$ans) }}">
              @csrf
              <input type="submit" value="編集">
            </form>

            <form action="{{ route('post.delete',$ans) }}" method="post">
              @csrf
              @method('DELETE')
              <input type="submit" value="削除">
            </form>

          </div>

        </div>
      <?php endforeach ?>
    </div>

    <div class="my_comment">
      <h3>コメント</h3>
      <?php $i = 0 ?>
      <?php foreach ($comments as $post) : ?>
        <div class=" part_post">
          <p>コメントした投稿</p>
          <div class="posts">
            <p class="title">タイトル: {{ $post->post_title }}</p><br>
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

              <div>

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
        </div>

        <?php ++$i ?>
      <?php endforeach ?>
    </div>
    <a href="{{ route('showTop') }}">記事一覧へ</a>


  </div>

</body>

</html>