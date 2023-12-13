@extends('layouts.layout')
@section('content')
  @foreach($users as $user)
    <div class="card-body">
      <form action="{{route('user.update',['user'=>Auth::user()->id])}}" method="post" class="was-validated">
        @csrf
        @method('PUT')
        <div>
          <lavel for='name' class="form-label">ユーザー名</lavel>
            <input type='text' name='name' value="{{$user['name']}}" class="form-control" required>
            <div class="invalid-feedback">
                ユーザー名の入力は必須です
            </div>
        </div>
        <div>
          <lavel for='email' class="form-label">メールアドレス</lavel>
            <input type='email' name='email' value="{{$user['email']}}" class="form-control" required>
          <div class="invalid-feedback">
                メールアドレスの入力は必須です
          </div>
        </div>
        <input type='submit' class="btn btn-primary">
      </form>
      <a href="{{route('password.request')}}">パスワード変更はこちらから</a>
      <a href="{{route('user.delete_show',['user'=>Auth::user()->id])}}">アカウント削除はこちらから</a>
    </div>
  @endforeach
@endsection