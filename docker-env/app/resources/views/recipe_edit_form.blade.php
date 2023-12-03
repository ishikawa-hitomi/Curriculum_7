@extends('layouts.layout')
@section('content')
  @if($errors->any())
      <ul>
        @foreach($errors->all() as $message)
          <li>{{$message}}</li>
        @endforeach
      </ul>
    @endif
  @foreach($recipes as $recipe)
  <form action="{{route('recipe_edit',['recipe'=>$recipe['id']])}}" method="post" enctype=”multipart/form-data”>
    @csrf
      <lavel for='main_image'>メイン画像</lavel>
        <input type='file' name='main_image' value="{{$recipe['main_image']}}">
      <lavel for='display_title'>表示用タイトル</lavel>
        <input type='text' name='display_title' value="{{$recipe['display_title']}}">
      <lavel for='title'>料理名</lavel>
        <input type='text' name='title' value="{{$recipe['title']}}">
      <lavel for='time'>調理時間目安</lavel>
        <input type='number' name='time' value="{{$recipe['time']}}">
      <lavel for='serve'>人数目安</lavel>
        <input type='number' name='serve' value="{{$recipe['serve']}}">
      <lavel for='memo'>メモ</lavel>
        <textarea name='memo'>{{$recipe['memo']}}</textarea>
      <lavel for='tag_id'>タグ</lavel>
      <select name='tag_id'>
        @foreach($tags as $tag)
          @if($tag['id']==$recipe['tag_id'])
          <option value="{{$tag['id']}}" selected>{{$tag['name']}}</option>
          @else
          <option value="{{$tag['id']}}">{{$tag['name']}}</option>
          @endif
        @endforeach
      </select>
      <a href="{{route('tag_create')}}">タグの追加</a>
    @endforeach
    <input type='submit'>
  </form>
@endsection