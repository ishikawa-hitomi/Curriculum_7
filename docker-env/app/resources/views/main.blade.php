@extends('layouts.layout')
@section('content')
  @foreach($recipes as $recipe)
      @if($recipe['user_id']==Auth::user()->id)
        <div class="card m-4">
          <a style="overflow:hidden;height:400px" href="{{route('my_post',['recipe'=>$recipe['recipe_id']])}}"><img class="card-img-top img-fluid" src="{{asset('storage/' . $recipe['main_image']) }}"></a>
          <div class="card-body">
            <a href="{{route('my_post',['recipe'=>$recipe['recipe_id']])}}" class="card-link">{{$recipe['display_title']}}</a>
            @if(is_null($recipe['icon']))
              <img class="col-sm-1 rounded-circle" src="{{asset('download20231202123050.png') }}">
            @else
              <img class="col-sm-1 rounded-circle" src="{{asset('storage/' . $recipe['icon']) }}">
            @endif
            <a href="{{route('page',['user'=>$recipe['user_id']])}}" class="card-link">{{$recipe['name']}}</a>
          </div>
        </div>
      @else
        <div class="card m-4">
          <a style="overflow:hidden;height:400px" href="{{route('others_post',['recipe'=>$recipe['recipe_id']])}}"><img class="card-img-top img-fluid" src="{{asset('storage/' . $recipe['main_image']) }}"></a></th>
          <div class="card-body">
            <a href="{{route('others_post',['recipe'=>$recipe['recipe_id']])}}" class="card-link">{{$recipe['display_title']}}</a>
            @if(is_null($recipe['icon']))
              <img class="col-sm-1 rounded-circle" src="{{asset('download20231202123050.png') }}">
            @else
              <img class="col-sm-1 rounded-circle" src="{{asset('storage/' . $recipe['icon']) }}">
            @endif
            <a href="{{route('page',['user'=>$recipe['user_id']])}}" class="card-link">{{$recipe['name']}}</a>
          </div>
        </div>
      @endif
  @endforeach
@endsection