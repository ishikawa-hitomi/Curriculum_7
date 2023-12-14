@extends('layouts.app')

@section('content')
<div>
  <h1>パスワード再設定メール送信フォーム</h1>
  <form method="post" action="{{ route('password_reset.email.send') }}">
    @csrf
    <div>
      <label for="email">メールアドレス</label>
      <input type="text" name="email" id="email" value="{{ old('email') }}">
      @error('email')
        <span class="error">{{ $message }}</span>
      @enderror
    </div>
    <input type="submit" value="再設定用メールを送信">
  </form>

  <a href="{{ route('login') }}">戻る</a>
</div>
@endsection