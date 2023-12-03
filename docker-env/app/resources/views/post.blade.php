@extends('layouts.layout')
@section('content')
@foreach($recipes as $recipe)
<a href="{{route('recipe_edit',['recipe'=>$recipe['id']])}}">
    <button>編集</button>
</a>
<a href="{{route('recipe_delete',['recipe'=>$recipe['id']])}}">
    <button>削除</button>
</a>
<table>
<tr>
    <th>{{$recipe['main_image']}}</th>
    <th>{{$recipe['display_title']}}</th>
    <th>{{$recipe['title']}}</th>
    <th>{{$recipe['time']}}</th>
    <th>{{$recipe['serve']}}</th>
    <th>{{$recipe['memo']}}</th>
    <th>{{$recipe['tag']['name']}}</th>
@endforeach
</tr>
</table>
@endsection