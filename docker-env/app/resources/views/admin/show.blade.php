@extends('layouts.layout')
@section('content')
  <div class="card">
    <h5 class="card-title">{{$users[0]['name']}}</h5>
    <div class="card-body">
      <p>{{$users[0]['profile']}}</p>
    </div>
    <div>
      <p>フォロー : {{count($users[0]['follower'])}}人</p>
      <p>フォロワー : {{count($users[0]['following'])}}人</p>
    </div>
    <div>
      <a class="btn btn-outline-primary" role="button" href="{{route('user.edit',['user'=>$users[0]['id']])}}">ユーザーを完全に削除する</a>
    </div>
    @foreach($users[0]['recipes'] as $recipe)
      <div class="card text-center m-2">
        <div class="card-header">
          <ul class="nav nav-pills card-header-pills">
            <li class="nav-item"><a class="nav-link" href="#">レシピを完全に削除する</a></li>
            @if($recipe['deleted_at']!=null)
              <li class="nav-item"><a class="nav-link" href="#">レシピの倫理削除を取り消す</a></li>
            @endif
          </ul>
        </div>
        <div class="card-body">
          <h6 class="card-title">{{$recipe['display_title']}}</h6>
          <p class="card-text">{{$recipe['title']}}</p>
        </div>
      </div>
    @endforeach
  </div>
@endsection