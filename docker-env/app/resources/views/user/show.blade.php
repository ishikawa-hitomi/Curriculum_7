@extends('layouts.layout')
@section('content')
  <div class="card">
        <h4 class="card-title">{{$users[0]['name']}}</h4>
      <div class="card-body">
        @if($users[0]['icon']===null)<!-- もしアイコンが設定されていなければデフォルトのアイコンを表示 -->
          <img class="col-sm-1 rounded-circle" src="{{asset('download20231202123050.png') }}">
        @else
          <img class="col-sm-1 rounded-circle" src="{{asset('storage/' . $users[0]['icon']) }}">
        @endif
        <p>{{$users[0]['profile']}}</p>
        @if($users[0]['id']==Auth::user()->id)
        @else<!-- フォロー機能 -->
          @if(in_array($users[0]['id'],$myfollow))
            <a href="{{ route('remove_follow',['user'=>$users[0]['id']])}}" class="btn btn-success btn-sm">
              フォローを消す
              <span class="badge"></span>
            </a>
          @else
            <a href="{{ route('add_follow',['user'=>$users[0]['id']])}}" class="btn btn-secondary btn-sm">
              フォローをつける
              <span class="badge"></span>
            </a>
          @endif
        @endif
      </div>
      <div class="nav">
        <a class="nav-link" href="{{route('follow_view',['user'=>$users[0]['id']])}}">フォロー<br>{{$follow}}</a>
        <a class="nav-link" href="{{route('follower_view',['user'=>$users[0]['id']])}}">フォロワー<br>{{$follower}}</a>
      </div>
  </div>
  @if($users[0]['id']==Auth::user()->id)<!-- もし自分のページなら編集ボタンを表示 -->
    <a class="btn btn-outline-primary" role="button" href="{{route('user.profile_edit',['user'=>$users[0]['id']])}}">プロフィール情報編集</a>
    <a class="btn btn-outline-primary" role="button" href="{{route('user.edit',['user'=>$users[0]['id']])}}">ユーザー情報編集</a>
  @endif
  <nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">投稿一覧</button>
      <button class="nav-link" id="nav-like-tab" data-bs-toggle="tab" data-bs-target="#nav-like" type="button" role="tab" aria-controls="nav-like" aria-selected="false">お気に入り一覧</button>
    </div>
    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
        <div class="row row-cols-1 row-cols-md-2">
          @foreach($users[0]['recipes'] as $recipe)<!-- 自分の投稿を表示 -->
            <div class="col">
              <div class="card m-4">
                <a href="{{route('recipe.show',['recipe'=>$recipe['id']])}}"><img class="card-img-top" src="{{asset('storage/' . $recipe['main_image']) }}"></a>
                <div class="card-body">
                  <a href="{{route('recipe.show',['recipe'=>$recipe['id']])}}" class="card-link">{{$recipe['display_title']}}</a>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
      <div class="tab-pane fade" id="nav-like" role="tabpanel" aria-labelledby="nav-like-tab">
        <div class="row row-cols-1 row-cols-md-2">
          @foreach($likes as $like)<!-- いいねした投稿を表示 -->
            <div class="col">
              <div class="card m-4">
                <a href="{{route('recipe.show',['recipe'=>$like['recipe_id']])}}"><img class="card-img-top" src="{{asset('storage/' . $like['main_image']) }}"></a>
                <div class="card-body">
                  <a href="{{route('recipe.show',['recipe'=>$like['recipe_id']])}}" class="card-link">{{$like['display_title']}}</a>
                  <a href="{{route('user.show',['user'=>$like['user_id']])}}" class="card-link"></a>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </nav>
@endsection