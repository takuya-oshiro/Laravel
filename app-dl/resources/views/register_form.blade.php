<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>本登録</title>
</head>

<body>
  @foreach ($errors->all() as $error)
  <li>{{$error}}</li>
  @endforeach

  @if (session('flash_message'))
  <div class="flash_message">
    {{ session('flash_message') }}
  </div>
  @endif

  <form action="{{ route('userRegistar') }}" method="post">
    @csrf
    <p>Email：<input type="text" name="email" value="{{ $email }}" readonly>
    <p>ニックネーム：<input type="text" name="nickname" value=""></p>
    <p>パスワード：<input type="password" name="password" value=""></p>
    <p>パスワード(再)：<input type="password" name="password_confirmation" value=""></p>
    <p><input type="submit" value="決定"></p>

  </form>


</body>

</html>