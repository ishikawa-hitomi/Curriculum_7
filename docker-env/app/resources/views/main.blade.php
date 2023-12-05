@extends('layouts.layout')
@section('content')
  @foreach($recipes as $recipe)
      @if($recipe['user_id']==Auth::user()->id)
        <div class="card m-4">
          <a href="{{route('my_post',['recipe'=>$recipe['recipe_id']])}}"><img class="card-img-top" src="{{asset('storage/' . $recipe['main_image']) }}"></a>
          <div class="card-body">
            <a href="{{route('my_post',['recipe'=>$recipe['recipe_id']])}}" class="card-link">{{$recipe['display_title']}}</a>
            <a href="{{route('my_page',['user'=>$recipe['user_id']])}}" class="card-link">{{$recipe['name']}}</a>
          </div>
        </div>
      @else
        <div class="card m-4">
          <a href="{{route('others_post',['recipe'=>$recipe['recipe_id']])}}"><img class="list_image" src="{{asset('storage/' . $recipe['main_image']) }}"></a></th>
          <div class="card-body">
            <a href="{{route('others_post',['recipe'=>$recipe['recipe_id']])}}" class="card-link">{{$recipe['display_title']}}</a>
            <a href="{{route('others_page',['user'=>$recipe['user_id']])}}" class="card-link">{{$recipe['name']}}</a>
          </div>
        </div>
      @endif
  @endforeach
@endsection