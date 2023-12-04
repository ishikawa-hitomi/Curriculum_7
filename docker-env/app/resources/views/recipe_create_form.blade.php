@extends('layouts.layout')
@section('content')
  @if($errors->any())
    <ul>
      @foreach($errors->all() as $message)
        <li>{{$message}}</li>
      @endforeach
    </ul>
  @endif
  <form action="{{route('recipe_create')}}" method="post" enctype="multipart/form-data" class="was-validated" novalidate>
    @csrf
    <div>
      <lavel for='main_image' class="form-label">メイン画像</lavel>
      <input type='file' name='main_image' class="form-control" required>
      <div class="invalid-feedback">
        サムネイルに使用する画像登録は必須です
      </div>
    </div>
    <div>
      <lavel for='display_title' class="form-label">表示用タイトル</lavel>
      <input type='text' name='display_title' class="form-control" value="{{old('display_title')}}"placeholder="卵を使用しないで作れる！簡単ふわふわスフレパンケーキ" required>
      <div class="invalid-feedback">
        表示用のタイトル入力は必須です
      </div>
    </div>
    <div>
      <lavel for='title' lass="form-label">料理名</lavel>
      <input type='text' name='title' class="form-control" value="{{old('title')}}" placeholder="パンケーキ" required>
      <div class="invalid-feedback">
        料理名入力は必須です
      </div>
    </div>
    <div>
      <lavel for='time' lass="form-label">調理時間目安</lavel>
      <input type='number' name='time' class="form-control" value="{{old('time')}}" required>
      <div class="invalid-feedback">
        調理の目安時間入力は必須です
      </div>
    </div>
    <div>
      <lavel for='serve' lass="form-label">人数目安</lavel>
      <input type='number' name='serve' class="form-control" value="{{old('serve')}}" required>
      <div class="invalid-feedback">
        人数の目安入力は必須です
      </div>
    </div>
    <div>
      <lavel for='tag_id' lass="form-label">タグ</lavel>
      <select name='tag_id' class="form-select" required>
      <option value="" disabled selected>タグを選択してください</option>
        @foreach($tags as $tag)
        <option value="{{$tag['id']}}">{{$tag['name']}}</option>
        @endforeach
      </select>
      <div class="invalid-feedback">
        タグ選択は必須です
      </div>
      <a href="{{route('tag_create')}}">タグの追加</a>
    </div>
    <div>
      <lavel for='memo' lass="form-label">メモ</lavel>
      <textarea name='memo' class="form-control">{{old('memo')}}</textarea>
    </div>
    <input type='submit' class="btn btn-primary">
  </form>
@endsection