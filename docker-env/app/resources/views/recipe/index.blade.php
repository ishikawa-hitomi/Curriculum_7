@extends('layouts.layout')
@section('content')
  @if(!empty($keyword)||!empty($from)||!empty($to))
    <div class="card mb-3">
      <h4 class="card-title text-center">@if(!empty($keyword))"{{$keyword}}" @endif @if(!empty($from))"{{$from}}" @endif @if(!empty($to))"{{$to}}" @endifの検索結果</h4>
      <div class="card-body">
        @foreach($search_recipes as $recipe)
          <div class="card mb-3">
            <div class="row">
              <div class="col-sm-5">
                <a href="{{route('recipe.show',['recipe'=>$recipe['id']])}}">
                  <img class="img-fluid h-100" style="object-fit: cover;" src="{{asset('storage/' . $recipe['main_image']) }}">
                </a>
              </div>
              <div class="col-sm-7">
                <div class="card-body">
                  <a href="{{route('recipe.show',['recipe'=>$recipe['id']])}}" class="nav-link link-dark">
                    <small>{{substr($recipe['created_at'],0,10)}}</small>
                    <h5 class="card-title">{{$recipe['display_title']}}</h5>
                    <p class="card-text">{{$recipe['memo']}}</P>
                  </a>
                  <a href="{{route('user.show',['user'=>$recipe['user_id']])}}" class="nav-link link-dark">
                    @if(is_null($recipe['user']['icon']))
                      <img class="col-1 rounded-circle" src="{{asset('download20231202123050.png') }}">
                    @else
                      <img class="col-1 rounded-circle" src="{{asset('storage/' . $recipe['user']['icon']) }}">
                    @endif
                    {{$recipe['user']['name']}}
                  </a>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
      <div class="d-flex justify-content-center">
        {!! $search_recipes->appends(['keyword' => $keyword,'from' => $from,'to' => $to])->onEachSide(2)->render() !!}
      </div>
    </div>
  @endif

<div class="card">
  <h4 class="card-title text-center">新着レシピ</h4>
  <div class="card-body">
    <div class="slider">
        @foreach($new_recipes as $recipe)
          <div class="card">
            <p class="text-center">{{substr($recipe['created_at'],0,10)}}</p>
            <a href="{{(route('recipe.show',['recipe'=>$recipe['id']]))}}"><img class="card-img-top" style="object-fit: cover;" src="{{asset('storage/' . $recipe['main_image']) }}"></a>
            <div class="card-body">
              <h5>{{$recipe['display_title']}}</h5>
              <p>いいね:{{count($recipe['likes'])}}</p>
              <p>{{$recipe['user']['name']}}</p>
            </div>
          </div>
        @endforeach
    </div>
  </div>
</div>

<div class="card">
  <h4 class="card-title text-center">いいねが多いレシピ</h4>
  <div class="card-body">
    <div class="slider">
        @foreach($good_recipes as $recipe)
          <div class="card">
            <p class="text-center">{{$loop->index+1}}位</p>
            <a href="{{(route('recipe.show',['recipe'=>$recipe['id']]))}}"><img class="card-img-top" style="object-fit: cover;" src="{{asset('storage/' . $recipe['main_image']) }}"></a>
            <div class="card-body">
              <h5>{{$recipe['display_title']}}</h5>
              <p>いいね:{{$recipe['count']}}</p>
              <p>{{$recipe['user']['name']}}</p>
            </div>
          </div>
        @endforeach
    </div>
  </div>
</div>
<script>
  $('.slider').slick({
    speed: 800,
    dots: true,
    arrows: true,
    centerMode:true,
    centerPadding:"30%",
  });
</script>
@endsection