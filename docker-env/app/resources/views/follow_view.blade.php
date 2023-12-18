@extends('layouts.layout')
@section('content')
  @foreach($follows as $user)
    <div class="container text-center">
      <div class="row m-2">
        <a  class="col-sm-10" href="{{route('user.show',['user'=>$user['following_id']])}}">
          <div class="row">
            @if($user['icon']===null)<!-- アイコンが設定されていなければデフォルトのアイコンを表示 -->
              <img class="col-sm-2 rounded-circle" src="{{asset('download20231202123050.png') }}">
            @else
              <img class="col-sm-2 rounded-circle" src="{{asset('storage/' . $user['icon']) }}">
            @endif
            <h6 class="col-sm-4">{{$user['name']}}</h6>
            <p class="col-sm-4">{{$user['profile']}}</p>
          </div>
        </a>
        @can('general')
          @if($user['following_id']!=Auth::user()->id)
            @if(in_array($user['following_id'],$myfollow))<!-- フォロー機能 -->
              <a href="{{ route('remove_follow',['user'=>$user['following_id']])}}" class="btn btn-success btn-sm col-sm-2">
                フォローを消す
                <span class="badge"></span>
              </a>
            @else
              <a href="{{ route('add_follow',['user'=>$user['following_id']])}}" class="btn btn-secondary btn-sm col-sm-2">
                フォローをつける
                <span class="badge"></span>
              </a>
            @endif
          @endif
        @endcan
      </div>
    </div>
  @endforeach
@endsection