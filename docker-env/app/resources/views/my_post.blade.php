@extends('layouts.layout')
@section('content')
    @foreach($recipes as $recipe)
    <div class="card">
        <div>
            <img class="card-img-top" src="{{asset('storage/' . $recipe['main_image']) }}">
            <a class="btn btn-outline-primary" role="button" href="{{route('recipe_edit',['recipe'=>$recipe['id']])}}">編集</a>
            <a class="btn btn-outline-primary" role="button" href="{{route('recipe_delete',['recipe'=>$recipe['id']])}}">削除</a>
        </div>
        <div class="card-body">
            <h4 class="card-title">{{$recipe['display_title']}}</h4>
            <span class="badge rounded-pill bg-primary">{{$recipe['tag']['name']}}</span>
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
            <p>{{$recipe['memo']}}</p>
        </div>
    </div>
    @endforeach
@endsection