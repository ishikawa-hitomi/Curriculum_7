@extends('layouts.layout')
@section('content')
    <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{$recipes[0]['display_title']}}</h4>
                <span class="badge rounded-pill bg-primary">{{$recipes[0]['tag']['name']}}</span>
                <div class="ratio ratio-21x9">
                    <img class="card-img-top" style="object-fit: cover;" src="{{asset('storage/' . $recipes[0]['main_image']) }}">
                </div>
                @if($recipes[0]['user_id']==Auth::user()->id)<!-- 投稿者にのみ編集、削除ボタンを表示 -->
                    <a class="btn btn-outline-primary" role="button" href="{{route('recipe.edit',['recipe'=>$recipes[0]['id']])}}">編集</a>
                    <a class="btn btn-outline-primary" role="button" href="{{route('recipe.delete_show',['recipe'=>$recipes[0]['id']])}}">削除</a>
                @else
                <div class="row m-2">
                    <div class="col-2" style="max-width:100px;">
                        <a href="{{route('user.show',['user'=>$recipes[0]['user_id']])}}"  class="ratio ratio-1x1">
                            @if($recipes[0]['user']['icon']===null)<!-- もしアイコンが設定されていなければデフォルトのアイコンを表示 -->
                                <img class="rounded-circle" src="{{asset('download20231202123050.png') }}">
                            @else
                                <img class="rounded-circle" src="{{asset('storage/' . $recipes[0]['user']['icon']) }}">
                            @endif
                        </a>
                    </div>
                    <div class="col-9 my-auto">
                    <a href="{{route('user.show',['user'=>$recipes[0]['user_id']])}}">{{$recipes[0]['user']['name']}}</a>
                    @can('admin')
                        <a class="btn btn-danger" role="button" href="#">完全に削除</a>
                    @endcan
                    @can('general')
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
                    @endcan
                    </div>
                    </div>
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
                        <th>材料名</th>
                        <th>分量</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recipes[0]['ingredients'] as $ingredient)
                        <tr>
                            <th>{{$ingredient['name']}}</th>
                            <th>{{$ingredient['quantity']}}</th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-body">
        @foreach($recipes[0]['steps'] as $step)
            <div class="card">
                <div class="row g-0 align-items-center">
                    <div class="col-md-1">
                        <h6 class="card-title text-center">手順{{$loop->index+1}}</h6>
                    </div>
                    <div class="col-md-4">
                        <div class="ratio ratio-16x9">
                            <img src="{{asset('storage/' . $step['sub_image']) }}" class="img-fluid rounded-start" style="object-fit: cover;">
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="card-body">
                            <p class="card-text">{{$step['procedure']}}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
        @if(!empty($recipes[0]['comments']))
            <div class="card m-5">
                <h5 class="card-title text-center">コメント一覧</h5>
                @foreach($recipes[0]['comments'] as $comment)
                    <div class="card-body">
                        <div class="col-md-10">
                            <p class="card-text">{{$comment['comment']}}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

@endsection