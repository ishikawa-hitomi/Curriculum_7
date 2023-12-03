@extends('layouts.layout')
@section('content')
  @if($errors->any())
    <ul>
      @foreach($errors->all() as $message)
        <li>{{$message}}</li>
      @endforeach
    </ul>
  @endif
  <form action="{{route('recipe_create')}}" method="post" enctype=”multipart/form-data”>
    @csrf
    <lavel for='main_image'>メイン画像</lavel>
      <input type='file' name='main_image' value="{{old('main_image')}}">
    <lavel for='display_title'>表示用タイトル</lavel>
      <input type='text' name='display_title' value="{{old('display_title')}}">
    <lavel for='title'>料理名</lavel>
      <input type='text' name='title' value="{{old('title')}}">
    <lavel for='time'>調理時間目安</lavel>
      <input type='number' name='time' value="{{old('time')}}">
    <lavel for='serve'>人数目安</lavel>
      <input type='number' name='serve' value="{{old('serve')}}">
    <lavel for='tag_id'>タグ</lavel>
      <select name='tag_id'>
        @foreach($tags as $tag)
        <option value="{{$tag['id']}}">{{$tag['name']}}</option>
        @endforeach
      </select>
      <a href="{{route('tag_create')}}">タグの追加</a>
    <lavel for='memo'>メモ</lavel>
      <textarea name='memo'>{{old('memo')}}</textarea>
    <input type='submit'>
  </form>
@endsection