@extends('layouts.layout')
@section('content')
  <div class="card">
    <h4 class="card-title">コメント投稿</h4>
  </div>
  <div>
    <form action="{{route('comment_create',['recipe'=>$recipeId])}}" method="post" class="needs-validation" novalidate>
      @csrf
      <div>
        <lavel for='comment' class="form-label">コメント</lavel>
        <textarea name='comment' class="form-control" required></textarea>
        <div class="invalid-feedback">
          コメントの入力は必須です
        </div>
      </div>
      <input type="hidden" name="recipe_id" value="{{$recipeId}}" required>
      <input type="hidden" name="user_id" value="{{Auth::user()->id}}" required>
      <input type="submit" class="btn btn-primary">
    </form>
  </div>
@endsection