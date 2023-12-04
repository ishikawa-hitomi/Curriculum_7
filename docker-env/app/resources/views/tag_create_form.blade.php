@extends('layouts.layout')
@section('content')
  <div class="card">
    <h4 class="card-title">タグ一覧</h4>
    <div>
      @foreach($tags as $tag)
      <span class="badge rounded-pill bg-primary">{{$tag['name']}}</span>
      @endforeach
    </div>
  </div>
  <div>
    <form action="{{route('tag_create')}}" method="post" class="needs-validation" novalidate>
      @csrf
      <div>
        <lavel for='name' class="form-label">タグの名前</lavel>
        <input type='text' name='name' id='name' class="form-control" required>
        <div class="invalid-feedback">
          Please choose a username.
        </div>
      </div>
      <input type="submit" class="btn btn-primary">
    </form>
  </div>
@endsection