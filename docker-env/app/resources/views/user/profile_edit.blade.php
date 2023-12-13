@extends('layouts.layout')
@section('content')
  @foreach($users as $user)
  <div class="card">
    <h4 class="card-title">プロフィール情報変更</h4>
    <div class="card-body">
      <form action="{{route('user.profile_update',['user'=>$user['id']])}}" method="post" enctype="multipart/form-data">
        @csrf
        <lavel for='icon' class="form-label">ユーザーアイコン</lavel>
          <input type='file' name='icon' class="form-control">
        <lavel for='profile' class="form-label">プロフィール</lavel>
          <textarea name='profile' class="form-control">{{$user['profile']}}</textarea>
        <input type='submit' class="btn btn-primary">
      </form>
    </div>
  </div>
  @endforeach
@endsection