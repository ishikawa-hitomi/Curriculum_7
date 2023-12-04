@extends('layouts.layout')
@section('content')
  @foreach($users as $user)
    <form action="{{route('profile_edit',['user'=>$user['id']])}}" method="post" enctype="multipart/form-data">
    @csrf
      <lavel for='icon'>ユーザーアイコン</lavel>
        <input type='file' name='icon'>
      <lavel for='profile'>プロフィール</lavel>
        <input type='text' name='profile' value="{{$user['profile']}}">
      <input type='submit'>
    </form>
  @endforeach
@endsection