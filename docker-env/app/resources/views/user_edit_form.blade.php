@extends('layouts.layout')
@section('content')
  @if($errors->any())
    <ul>
      @foreach($errors->all() as $message)
        <li>{{$message}}</li>
      @endforeach
    </ul>
  @endif
  @foreach($users as $user)
    <form action="{{route('user_edit',['user'=>Auth::user()->id])}}" method="post">
    @csrf
      <lavel for='name'>ユーザー名</lavel>
        <input type='text' name='name' value="{{$user['name']}}">
      <lavel for='email'>メールアドレス</lavel>
        <input type='email' name='email' value="{{$user['email']}}">
      <input type='submit'>
    </form>
    <a href="{{route('password.request')}}">パスワード変更はこちらから</a>
    <a href="{{route('user_delete',['user'=>Auth::user()->id])}}">アカウント削除はこちらから</a>
  @endforeach
@endsection