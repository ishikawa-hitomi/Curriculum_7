@extends('layouts.layout')
@section('content')
  @foreach($users as $user)
    <div class="card">
      <div class="alert alert-danger" role="alert">
        アカウントに関する全ての情報が削除されます。<br>削除する場合はパスワードを入力し、[削除する]ボタンを押してください。
      </div>
      <h4 class="card-title">{{$user['name']}}</h4>
      <div class="card-body">
        @if($user['icon']===null)<!-- もしアイコンが設定されていなければデフォルトのアイコンを表示 -->
          <img class="col-1 rounded-circle" src="{{asset('download20231202123050.png') }}">
        @else
          <img class="col-1 rounded-circle" src="{{asset('storage/' . $user['icon']) }}">
        @endif
        <p>{{$user['profile']}}</p>
      </div>
      <ul>
        <li>フォロー:{{count($user['follower'])}}</li>
        <li>フォロワー:{{count($user['following'])}}</li>
        <li>レシピ:{{count($user['recipes'])}}</li>
      </ul>
    </div>
    @if(session()->has('delete_user_message'))
      <div class="alert alert-danger" role="alert">
        {{session()->pull('delete_user_message')}}
      </div>
    @endif
    <form action="{{route('user.destroy',['user'=>Auth::user()->id])}}" method="post" class="needs-validation" novalidate>
      @csrf
      @method('DELETE')
      <div>
        <lavel for='password' class="form-label">パスワード</lavel>
        <input type="password" name="password" class="form-control" minlength=8 required>
          <div class="invalid-feedback">
            メールアドレスの入力は必須です
          </div>
      </div>
      <input type="submit" value="削除する">
    </form>
  @endforeach
  <script>
    // 無効なフィールドがある場合にフォーム送信を無効にするスターターJavaScriptの例
    (() => {
      'use strict'

    // Bootstrapカスタム検証スタイルを適用してすべてのフォームを取得
    const forms = document.querySelectorAll('.needs-validation')

    // ループして帰順を防ぐ
    Array.from(forms).forEach(form => {
      form.addEventListener('submit', event => {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
    })()
  </script>
@endsection