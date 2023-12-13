@extends('layouts.layout')
@section('content')
  @foreach($recipes as $recipe)
        <div class="card m-4">
          <a style="overflow:hidden;height:400px" href="{{route('recipe.show',['recipe'=>$recipe['id']])}}"><img class="card-img-top img-fluid" src="{{asset('storage/' . $recipe['main_image']) }}"></a>
          <div class="card-body">
            <a href="{{route('recipe.show',['recipe'=>$recipe['id']])}}" class="card-link">{{$recipe['display_title']}}</a>
            @if(is_null($recipe['user']['icon']))
              <img class="col-sm-1 rounded-circle" src="{{asset('download20231202123050.png') }}">
            @else
              <img class="col-sm-1 rounded-circle" src="{{asset('storage/' . $recipe['user']['icon']) }}">
            @endif
            <a href="{{route('user.show',['user'=>$recipe['user_id']])}}" class="card-link">{{$recipe['user']['name']}}</a>
          </div>
        </div>
  @endforeach
@endsection