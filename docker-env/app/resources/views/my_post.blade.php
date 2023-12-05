@extends('layouts.layout')
@section('content')
    <div class="card">
        @foreach($recipes as $recipe)
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
        @endforeach
        <div class="card-body">
            <table class="table">
                <thead class="table-primary">
                    <tr>
                        <th>#番号</th>
                        <th>材料名</th>
                        <th>分量</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ingredients as $ingredient)
                        <tr>
                            <th></th>
                            <th>{{$ingredient['name']}}</th>
                            <th>{{$ingredient['quantity']}}</th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @foreach($steps as $step)
            <div class="card card-body">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="{{asset('storage/' . $step['sub_image']) }}" class="img-fluid rounded-start">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">{{$step['procedure']}}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection