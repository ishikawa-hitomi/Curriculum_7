@extends('layouts.layout')
@section('content')
  <div class="card">
    @foreach($users as $user)
        <h4 class="card-title">{{$user['name']}}</h4>
      <div class="card-body">
        <img class="" src="{{asset('storage/' . $user['icon']) }}">
        <p>{{$user['profile']}}</p>
      </div>
    @endforeach
  </div>
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
                    <a href="{{route('my_post',['recipe'=>$recipe['id']])}}" class="card-link">{{$recipe['title']}}</a>
                  </div>
                </div>
              </div>
          @endforeach
        </div>
      </div>
      <div class="tab-pane fade" id="nav-like" role="tabpanel" aria-labelledby="nav-like-tab">
        <div class="row row-cols-1 row-cols-md-2">
            @foreach($recipes as $recipe)
              <div class="col">
                <div class="card m-4">
                  <a href="{{route('my_post',['recipe'=>$recipe['id']])}}"><img class="card-img-top" src="{{asset('storage/' . $recipe['main_image']) }}"></a>
                  <div class="card-body">
                    <a href="{{route('my_post',['recipe'=>$recipe['id']])}}" class="card-link">{{$recipe['display_title']}}</a>
                    <a href="{{route('my_post',['recipe'=>$recipe['id']])}}" class="card-link">{{$recipe['title']}}</a>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
      </div>
    </div>
  </nav>
@endsection