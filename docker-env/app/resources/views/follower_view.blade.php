@extends('layouts.layout')
@section('content')
  @foreach($followers as $user)
    <div class="container text-center">
      <div class="row m-2">
        @if($user['follower_id']==Auth::user()->id)
          <a  class="col-sm-10" href="{{route('my_page',['user'=>$user['follower_id']])}}">
            <div class="row">
              @if($user['icon']===null)
                <img class="col-sm-2 rounded-circle" src="{{asset('download20231202123050.png') }}">
              @else
                <img class="col-sm-2 rounded-circle" src="{{asset('storage/' . $user['icon']) }}">
              @endif
              <h6 class="col-sm-4">{{$user['name']}}</h6>
              <p class="col-sm-4">{{$user['profile']}}</p>
            </div>
          </a>
        @else
          <a  class="col-sm-10" href="{{route('others_page',['user'=>$user['follower_id']])}}">
            <div class="row">
              @if($user['icon']===null)
                <img class="col-sm-2 rounded-circle" src="{{asset('download20231202123050.png') }}">
              @else
                <img class="col-sm-2 rounded-circle" src="{{asset('storage/' . $user['icon']) }}">
              @endif
              <h6 class="col-sm-4">{{$user['name']}}</h6>
              <p class="col-sm-4">{{$user['profile']}}</p>
            </div>
          </a>
          @if(in_array($user['follower_id'],$myfollow))
            <a href="{{ route('remove_follow',['user'=>$user['id']])}}" class="btn btn-success btn-sm col-sm-2">
              フォローを消す
              <span class="badge"></span>
            </a>
          @else
            <a href="{{ route('add_follow',['user'=>$user['id']])}}" class="btn btn-secondary btn-sm col-sm-2">
              フォローをつける
              <span class="badge"></span>
            </a>
          @endif
        @endif
      </div>
    </div>
  @endforeach
@endsection