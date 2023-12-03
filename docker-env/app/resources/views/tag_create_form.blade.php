@extends('layouts.layout')
@section('content')
  タグ一覧
  @foreach($tags as $tag)
  <p>tag['name']</p>
  @endforeach
  <form action="{{route('tag_create')}}" method="post">
    @csrf
    <lavel for='name'>タグの名前</lavel>
      <input type='text' name='name'>
    <input type="submit">
  </form>
@endsection