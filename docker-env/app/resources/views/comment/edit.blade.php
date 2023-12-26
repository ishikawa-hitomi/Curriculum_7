@extends('layouts.layout')
@section('content')
  @foreach($comments as $comment)
    <div class="card">
      <form action="{{route('comment.update',['comment'=>$comment['id']])}}" method="POST">
        @csrf
        @method('PUT')
        <div>
          <lavel for='comment' class="form-label">コメント</lavel>
          <textarea class="form-control" name="comment" required maxlength:255>{{$comment['comment']}}</textarea>
        </div>
        <input type="hidden" value="{{Auth::user()->id}}" name="user_id" required>
        <input type="hidden" value="{{$comment['recipe_id']}}" name="recipe_id" required>
        <input type="submit" class="btn btn-primary">
        <a href="{{route('comment.show',['recipe'=>$comment['recipe_id']])}}">戻る</a>
      </form>
    </div>
  @endforeach
@endsection