@extends('layouts.layout')
@section('content')
  @foreach($recipes as $recipe)
    <table>
      <tr>
        <th>{{$recipe['main_image']}}</th>
        <th>{{$recipe['display_title']}}</th>
        <th>{{$recipe['title']}}</th>
        <th>{{$recipe['time']}}</th>
        <th>{{$recipe['serve']}}</th>
        <th>{{$recipe['memo']}}</th>
        <th>{{$recipe['tag']['name']}}</th>
      </tr>
    </table>
    <form action="{{route('recipe_delete',['recipe'=>$recipe['id']])}}" method="post">
      @csrf
      <input type="hidden" name="del_flg" value="0">
      <input type='submit' value="削除">
      <a type="button" href="{{route('recipe.show',['recipe'=>$recipe['id']])}}">戻る</a>
    </form>
  @endforeach
@endsection