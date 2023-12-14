@extends('layouts.layout')
@section('content')
    <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{$recipes[0]['display_title']}}</h4>
                <span class="badge rounded-pill bg-primary">{{$recipes[0]['tag']['name']}}</span>
                <img class="card-img-top" src="{{asset('storage/' . $recipes[0]['main_image']) }}">
                @if($recipes[0]['user_id']==Auth::user()->id)<!-- 投稿者にのみ編集、削除ボタンを表示 -->
                <a class="btn btn-outline-primary" role="button" href="{{route('recipe.edit',['recipe'=>$recipes[0]['id']])}}">編集</a>
                <a class="btn btn-outline-primary" role="button" href="{{route('recipe.delete_show',['recipe'=>$recipes[0]['id']])}}">削除</a>
                @else
                    <a href="{{route('user.show',['user'=>$recipes[0]['user_id']])}}">
                        @if($recipes[0]['user']['icon']===null)<!-- もしアイコンが設定されていなければデフォルトのアイコンを表示 -->
                            <img class="col-sm-1 rounded-circle" src="{{asset('download20231202123050.png') }}">
                        @else
                            <img class="col-sm-1 rounded-circle" src="{{asset('storage/' . $recipes[0]['user']['icon']) }}">
                        @endif
                    </a>
                    <a href="{{route('user.show',['user'=>$recipes[0]['user_id']])}}">{{$recipes[0]['user']['name']}}</a>
                    @if(in_array($recipes[0]['id'],$mylikes))<!-- いいね機能 -->
                    <a href="{{ route('remove_like',['recipe'=>$recipes[0]['id']])}}" class="btn btn-success btn-sm">
                        いいねを消す
                        <span class="badge"></span>
                    </a>
                    @else
                    <a href="{{ route('add_like',['recipe'=>$recipes[0]['id']])}}" class="btn btn-secondary btn-sm">
                        いいねをつける
                        <span class="badge"></span>
                    </a>
                    @endif
                    <a href="{{route('comment_create',['recipe'=>$recipes[0]['id']])}}" class="btn btn-primary btn-sm">コメントを投稿する</a>
                @endif
                <div class="card-group">
                    <div class="card">
                        <div class="card-body">
                            <span class="badge bg-primary">投稿日</span>
                            <span>{{substr($recipes[0]['created_at'],0,10)}}</span>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <span class="badge bg-primary">調理時間</span>
                            <span>{{$recipes[0]['time']}}分</span>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <span class="badge bg-primary">人数目安</span>
                            <span>{{$recipes[0]['serve']}}人分</span>
                        </div>
                    </div>
                </div>
                <p>{{$recipes[0]['memo']}}</p>
            </div>
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
                    @foreach($recipes[0]['ingredients'] as $ingredient)
                        <tr>
                            <th></th>
                            <th>{{$ingredient['name']}}</th>
                            <th>{{$ingredient['quantity']}}</th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @foreach($recipes[0]['steps'] as $step)
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
        <div class="card card-body m-5">
            @foreach($recipes[0]['comments'] as $comment)
                <div class="row">
                    <div class="col-md-10">
                            <p class="card-text">{{$comment['comment']}}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection