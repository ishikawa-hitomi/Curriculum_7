@extends('layouts.layout')
@section('content')
  @foreach($followers as $user)
    <div class="card mx-auto"  style="max-width:600px;">
      <div class="row  m-2">
        <div class="col-2" style="max-width:100px;">
          <a href="{{route('user.show',['user'=>$user['follower_id']])}}" class="ratio ratio-1x1">
            @if($user['icon']===null)<!-- アイコンが設定されていなければデフォルトのアイコンを表示 -->
              <img class="rounded-circle" src="{{asset('download20231202123050.png') }}">
            @else
              <img class="rounded-circle" src="{{asset('storage/' . $user['icon']) }}">
            @endif
          </a>
        </div>
        <div class="col">
          <a href="{{route('user.show',['user'=>$user['following_id']])}}" class="link-dark text-decoration-none">
            {{$user['name']}}<br>{{$user['profile']}}
          </a>
        </div>
        <div class="col-3 my-auto d-flex justify-content-end">
          @can('general')
            @if($user['follower_id']!=Auth::user()->id)
              @if(in_array($user['follower_id'],$myfollow))<!-- フォロー機能 -->
                <a href="{{ route('remove_follow',['user'=>$user['id']])}}" class="btn btn-outline-danger btn-sm">
                  フォロー解除
                  <span class="badge"></span>
                </a>
              @else
                <a href="{{ route('add_follow',['user'=>$user['id']])}}" class="btn btn-outline-primary btn-sm">
                &emsp;フォロー&emsp;
                  <span class="badge"></span>
                </a>
              @endif
            @endif
          @endcan
        </div>
      </div>
    </div>
  @endforeach
@endsection