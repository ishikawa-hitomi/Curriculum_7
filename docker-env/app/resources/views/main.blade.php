@extends('layouts.layout')
@section('content')
<table>
@foreach($recipes as $recipe)
  <tr>
    <th><a href="{{route('post',['recipe'=>$recipe['id']])}}">{{$recipe['display_title']}}</a></th>
    <th><a href="{{route('post',['recipe'=>$recipe['id']])}}">{{$recipe['title']}}</a></th>
  </tr>
@endforeach
</table>
@endsection