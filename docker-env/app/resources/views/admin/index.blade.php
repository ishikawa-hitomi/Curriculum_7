@extends('layouts.layout')
@section('content')
  <div class="card">
    <div class="card-body">
      <nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">ユーザー一覧</button>
      <button class="nav-link" id="nav-like-tab" data-bs-toggle="tab" data-bs-target="#nav-like" type="button" role="tab" aria-controls="nav-like" aria-selected="false">削除済みユーザー一覧</button>
    </div>
    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
        <div class="row row-cols-1 row-cols-md-2">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">名前</th>
                <th scope="col">投稿</th>
                <th scope="col">いいね</th>
                <th scope="col">フォロー</th>
                <th scope="col">フォロワー</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              @foreach($users as $user)
                <tr>
                  <th scope="row">{{$user['id']}}</th>
                  <td>{{$user['name']}}</td>
                  <td>{{count($user['recipes'])}}</td>
                  <td>{{count($user['likes'])}}</td>
                  <td>{{count($user['follower'])}}</td>
                  <td>{{count($user['following'])}}</td>
                  @if($user['deleted_at']!=null)
                  <td><a class="btn btn-primary" role="button" href="{{route('admin.show',['user'=>$user['id']])}}">復元</a></td>
                  @else
                    <td><a class="btn btn-primary" role="button" href="{{route('admin.show',['user'=>$user['id']])}}">詳細</a></td>
                  @endif
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <div class="tab-pane fade" id="nav-like" role="tabpanel" aria-labelledby="nav-like-tab">
        <div class="row row-cols-1 row-cols-md-2">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">名前</th>
                <th scope="col">投稿</th>
                <th scope="col">いいね</th>
                <th scope="col">フォロー</th>
                <th scope="col">フォロワー</th>
                <th scope="col"></th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              @foreach($del_users as $user)
                <tr>
                  <th scope="row">{{$user['id']}}</th>
                  <td>{{$user['name']}}</td>
                  <td>{{count($user['recipes'])}}</td>
                  <td>{{count($user['likes'])}}</td>
                  <td>{{count($user['follower'])}}</td>
                  <td>{{count($user['following'])}}</td>
                  <td><form action="{{route('admin.restore',['user'=>$user['name']])}}" method="post">@csrf<input type="submit" class="btn btn-primary" href="{{route('admin.restore',['user'=>$user['id']])}}" value="復元"><form></td>
                  <td><input type="submit" class="btn btn-danger" href="{{route('admin.show',['user'=>$user['id']])}}" value="完全削除"></td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </nav>
    </div>
  </div>
@endsection