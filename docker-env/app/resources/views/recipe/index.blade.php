@extends('layouts.layout')
@section('content')
  @foreach($new_recipes as $recipe)
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

<div class="card">
    <h4 class="card-title text-center">新着レシピ</h4>
  <div class="card-body">
    <div id="carouselExampleCaptions" class="carousel slide" data-pause="true">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item px-5 active">
          <div class="row">
            @for($a=0; $a<=2; $a++)
              <div class="col-4">
                <div class="card">
                  <img class="card-img-top" style="object-fit: cover;" src="{{asset('storage/' . $new_recipes[$a]['main_image']) }}">
                  <div class="card-body">
                    <h5>{{$new_recipes[$a]['display_title']}}</h5>
                    <p>{{$new_recipes[$a]['user']['name']}}</p>
                  </div>
                </div>
              </div>
            @endfor
          </div>
        </div>
        <div class="carousel-item px-5">
          <div class="row">
            @for($a=3; $a<=5; $a++)
              <div class="col-4">
                <div class="card">
                  <img class="card-img-top" style="object-fit: cover;" src="{{asset('storage/' . $new_recipes[$a]['main_image']) }}">
                  <div class="card-body">
                    <h5>{{$new_recipes[$a]['display_title']}}</h5>
                    <p>{{$new_recipes[$a]['user']['name']}}</p>
                  </div>
                </div>
              </div>
            @endfor
          </div>
        </div>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

@endsection