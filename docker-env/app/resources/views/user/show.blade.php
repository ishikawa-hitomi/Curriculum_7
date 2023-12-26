@extends('layouts.layout')
@section('content')
  <div class="card border-light">
      <div class="card-body">
        <div class="row aline-center">
          <div class="col-2">
            <div class="ratio ratio-1x1">
              @if($users[0]['icon']===null)<!-- もしアイコンが設定されていなければデフォルトのアイコンを表示 -->
                <img class="rounded-circle" style="object-fit: cover;" src="{{asset('download20231202123050.png') }}">
              @else
                <img class="rounded-circle" style="object-fit: cover;" src="{{asset('storage/' . $users[0]['icon']) }}">
              @endif
            </div>
          </div>
          <div class="col-10">
            <p>{{$users[0]['name']}}</p>
            <p>{{$users[0]['profile']}}</p>
          </div>
        </div>
        @can('admin')<!-- ユーザー削除　ここはあとで完全削除に差し替える -->
          <form action="{{route('admin.user_delete',['user'=>$users[0]['id']])}}" method="post">
            @csrf
            <input type="submit" value="ユーザーを削除する">
          </form>
        @endcan
        @can('general')
          @if($users[0]['id']!=Auth::user()->id)<!-- フォロー機能 -->
            @if(in_array($users[0]['id'],$myfollow))
              <a href="{{ route('remove_follow',['user'=>$users[0]['id']])}}" class="btn btn-outline-danger btn-sm">
                フォロー解除
                <span class="badge"></span>
              </a>
            @else
              <a href="{{ route('add_follow',['user'=>$users[0]['id']])}}" class="btn btn-outline-primary btn-sm">
                フォロー
                <span class="badge"></span>
              </a>
            @endif
          @endif
        @endcan
      </div>
      <div class="nav">
        <a class="nav-link link-dark" href="{{route('follow_view',['user'=>$users[0]['id']])}}">{{$follow}}&nbsp;<small>フォロー</small></a>
        <a class="nav-link link-dark" href="{{route('follower_view',['user'=>$users[0]['id']])}}">{{$follower}}&nbsp;<small>フォロワー</small></a>
      </div>
    </div>
  @if($users[0]['id']==Auth::user()->id)<!-- もし自分のページなら編集ボタンを表示 -->
    <a class="btn btn-outline-primary" role="button" href="{{route('user.profile_edit',['user'=>$users[0]['id']])}}">プロフィール情報編集</a>
    <a class="btn btn-outline-primary" role="button" href="{{route('user.edit',['user'=>$users[0]['id']])}}">ユーザー情報編集</a>
  @endif
  <nav class="mt-2">
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">投稿一覧</button>
      <button class="nav-link" id="nav-like-tab" data-bs-toggle="tab" data-bs-target="#nav-like" type="button" role="tab" aria-controls="nav-like" aria-selected="false">お気に入り一覧</button>
    </div>
    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-2 row-cols-xxl-3">
          @foreach($users[0]['recipes'] as $recipe)<!-- 自分の投稿を表示 -->
            <div class="col">
              <div class="card m-1">
                <a href="{{route('recipe.show',['recipe'=>$recipe['id']])}}" class="ratio ratio-4x3"><img class="card-img-top" style="object-fit: cover;" src="{{asset('storage/' . $recipe['main_image']) }}"></a>
                <div class="card-body">
                  <a href="{{route('recipe.show',['recipe'=>$recipe['id']])}}" class="card-link link-dark text-decoration-none">{{$recipe['display_title']}}</a>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
      <div class="tab-pane fade" id="nav-like" role="tabpanel" aria-labelledby="nav-like-tab">
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-2 row-cols-xxl-3">
          @foreach($likes as $like)<!-- いいねした投稿を表示 -->
            <div class="col">
              <div class="card m-1">
                <a href="{{route('recipe.show',['recipe'=>$like['recipe_id']])}}" class="ratio ratio-4x3"><img class="card-img-top" style="object-fit: cover;" src="{{asset('storage/' . $like['main_image']) }}"></a>
                <div class="card-body">
                  <a href="{{route('recipe.show',['recipe'=>$like['recipe_id']])}}" class="card-link link-dark text-decoration-none">{{$like['display_title']}}</a>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </nav>
@endsection