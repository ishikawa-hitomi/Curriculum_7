@extends('layouts.layout')
@section('content')
  <div class="card">
    <div class="card-body">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">名前</th>
            <th scope="col">投稿</th>
            <th scope="col">削除</th>
            <th scope="col">いいね</th>
            <th scope="col">フォロー</th>
            <th scope="col">フォロワー</th>
            <th scope="col">詳細</th>
          </tr>
        </thead>
        <tbody>
          @foreach($users as $user)
            <tr>
              <th scope="row">{{$user['id']}}</th>
              <td>{{$user['name']}}</td>
              <td>{{count($user['recipes'])}}</td>
              <td>
                @if($user['deleted_at']!=null)
                  済
                @endif
              </td>
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
@endsection