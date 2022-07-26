<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>新規ユーザー登録</title>
</head>

<body>
  <form action="{{ route('applyEmail') }}" method="post">
    @csrf
    <p>Email:<input type="text" name="email"></p>
    <p><input type="submit" value="送信"></p>
    @if ($errors->first('email'))
    <div>{{ $errors->first('email') }}</div>
    @endif


    @if (session('flash_message'))
    <div class="flash_message">
      {{ session('flash_message') }}
    </div>
    @endif
  </form>
</body>

</html>