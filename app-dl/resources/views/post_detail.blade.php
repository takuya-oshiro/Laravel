<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>記事詳細</title>
</head>

<body>
  <br>
  <?php echo $detail['name'] ?>
  <?php echo $detail['post_title'] ?>
  <?php echo $detail['post_content'] ?>
  <?php echo $detail['updated_at'] ?>
  <br>
  <div>-----------------------------------</div>
  <div>
    <form action="/comment" method="POST">
      @csrf
      <textarea name="comment" cols="30" rows="3"></textarea><br>
      <input type="hidden" name="post_id" value="<?php echo $detail['id'] ?>">
      <input type="submit" value="コメントする">
    </form>
  </div>
  -----------------------------------<br>
  コメント一覧:
  <div>
    <?php foreach ($detail->comments as $comments) : ?>
      <?php echo $comments->name ?>
      <?php echo $comments->comment ?>
      <?php echo $comments->created_at ?><br>
    <?php endforeach ?>
    <a href="/top">記事一覧へ</a>
  </div>
</body>

</html>