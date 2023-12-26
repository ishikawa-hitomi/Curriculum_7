@extends('layouts.layout')
@section('content')
  @foreach($recipes as $recipe)
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">{{$recipe['display_title']}}</h4>
      <div class="ratio ratio-21x9">
        <img class="card-img-top" style="object-fit: cover;" src="{{asset('storage/' . $recipe['main_image']) }}">
      </div>
      <div class="card-group">
        <div class="card">
          <div class="card-body">
            <span class="badge bg-primary">投稿日</span>
            <span>{{substr($recipe['created_at'],0,10)}}</span>
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <span class="badge bg-primary">調理時間</span>
            <span>{{$recipe['time']}}分</span>
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <span class="badge bg-primary">人数目安</span>
            <span>{{$recipe['serve']}}人分</span>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-title">ひとことメモ</div>
        <div class="card-body">
          <p>{{$recipe['memo']}}</p>
        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="alert alert-danger" role="alert">レシピを削除しますか？</div>
      <form action="{{route('recipe.destroy',['recipe'=>$recipe['id']])}}" method="post">
        @csrf
        @method('DELETE')
        <input type='submit' value="削除" class="btn btn-danger">
        <a type="button" href="{{route('recipe.show',['recipe'=>$recipe['id']])}}" class="btn btn-outline-primary">戻る</a>
      </form>
    </div>
  </div>
  @endforeach
@endsection