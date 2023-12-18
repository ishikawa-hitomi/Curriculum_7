@extends('layouts.layout')
@section('content')
  <div class="card">
    <div>
      <form action="{{route('admin.user_index')}}" method="GET">
        <div>
          <label name="user_id" class="form-label">ID</label>
          <input type="number" name="user_id" class="form-control form-control-sm" value="{{e(request()->input('user_id'))}}"></div>
        <div>
          <label name="date" class="form-label">投稿日</label>
          <input type="date" name="from" class="form-control form-control-sm" value="{{e(request()->input('from'))}}">
          -
          <input type="date" name="to" class="form-control form-control-sm" value="{{e(request()->input('to'))}}">
        </div>
        <input type="submit" value="検索">
      </form>
    </div>
    <div class="nav nav-tabs">
    <a class="nav-link active">ユーザー一覧</a>
      <a href="{{route('admin.del_user_index')}}" class="nav-link">削除済みユーザー一覧</a>
    </div>
    <div class="card-body">
      <div class="row">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th scope="col">@sortablelink('id', 'ID')</th>
              <th scope="col">@sortablelink('name', '名前')</th>
              <th scope="col">@sortablelink('created_at', '作成日')</th>
              <th scope="col">投稿</th>
              <th scope="col">いいね</th>
              <th scope="col">フォロー</th>
              <th scope="col">フォロワー</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            @if($users==null)
              <br><strong>一致する検索結果はありません</strong>
            @endif
            @foreach($users as $user)
              <tr>
                <th scope="row">{{$user['id']}}</th>
                <td>{{$user['name']}}</td>
                <td>{{substr($user['created_at'],0,10)}}</td>
                <td>{{count($user['recipes'])}}</td>
                <td>{{count($user['likes'])}}</td>
                <td>{{count($user['follower'])}}</td>
                <td>{{count($user['following'])}}</td>
                <td><a class="btn btn-primary" role="button" href="{{route('user.show',['user'=>$user['id']])}}">詳細</a></td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection