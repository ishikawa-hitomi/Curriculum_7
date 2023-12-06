@extends('layouts.layout')
@section('content')
  <div class="card">
    @foreach($users as $user)
        <h4 class="card-title">{{$user['name']}}</h4>
      <div class="card-body">
        @if($user['icon']===null)
          <img class="col-sm-1 rounded-circle" src="{{asset('download20231202123050.png') }}">
        @else
          <img class="col-sm-1 rounded-circle" src="{{asset('storage/' . $user['icon']) }}">
        @endif
        <p>{{$user['profile']}}</p>
      </div>
      <div class="nav">
        <a class="nav-link" href="{{route('follow_view',['user'=>$user['id']])}}">フォロー<br>{{$follow}}</a>
        <a class="nav-link" href="{{route('follower_view',['user'=>$user['id']])}}">フォロワー<br>{{$follower}}</a>
      </div>
    @endforeach
  </div>
  <a class="btn btn-outline-primary" role="button" href="{{route('profile_edit',['user'=>$user['id']])}}">プロフィール情報編集</a>
  <a class="btn btn-outline-primary" role="button" href="{{route('user_edit',['user'=>$user['id']])}}">ユーザー情報編集</a>
  <nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">投稿一覧</button>
      <button class="nav-link" id="nav-like-tab" data-bs-toggle="tab" data-bs-target="#nav-like" type="button" role="tab" aria-controls="nav-like" aria-selected="false">お気に入り一覧</button>
    </div>
    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
        <div class="row row-cols-1 row-cols-md-2">
          @foreach($recipes as $recipe)
            <div class="col">
              <div class="card m-4">
                <a href="{{route('my_post',['recipe'=>$recipe['id']])}}"><img class="card-img-top" src="{{asset('storage/' . $recipe['main_image']) }}"></a>
                <div class="card-body">
                  <a href="{{route('my_post',['recipe'=>$recipe['id']])}}" class="card-link">{{$recipe['display_title']}}</a>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
      <div class="tab-pane fade" id="nav-like" role="tabpanel" aria-labelledby="nav-like-tab">
        <div class="row row-cols-1 row-cols-md-2">
          @foreach($likes as $like)
            <div class="col">
              <div class="card m-4">
                <a href="{{route('others_post',['recipe'=>$like['recipe_id']])}}"><img class="card-img-top" src="{{asset('storage/' . $like['main_image']) }}"></a>
                <div class="card-body">
                  <a href="{{route('others_post',['recipe'=>$like['recipe_id']])}}" class="card-link">{{$like['display_title']}}</a>
                  <a href="{{route('others_page',['user'=>$like['user_id']])}}" class="card-link">{{$like['name']}}</a>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </nav>
@endsection