@extends('layouts.layout')
@section('content')
    <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{$recipes[0]['display_title']}}</h4>
                    @foreach($tags as $tag)
                        @if($recipes[0]['tag_id_1']==$tag['id']||$recipes[0]['tag_id_2']==$tag['id']||$recipes[0]['tag_id_3']==$tag['id']||$recipes[0]['tag_id_4']==$tag['id']||$recipes[0]['tag_id_5']==$tag['id'])
                        <span class="badge rounded-pill bg-primary">{{$tag['name']}}</span>
                        @endif
                    @endforeach
                <div class="ratio ratio-21x9">
                    <img class="card-img-top" style="object-fit: cover;" src="{{asset('storage/' . $recipes[0]['main_image']) }}">
                </div>
                @if($recipes[0]['user_id']==Auth::user()->id)<!-- 投稿者にのみ編集、削除ボタンを表示 -->
                    <a class="btn btn-outline-primary" role="button" href="{{route('recipe.edit',['recipe'=>$recipes[0]['id']])}}">編集</a>
                    <a class="btn btn-outline-primary" role="button" href="{{route('recipe.delete_show',['recipe'=>$recipes[0]['id']])}}">削除</a>
                @else
                <div class="row m-2">
                <div class="col-4">
                    <div class="d-flex">
                        <a href="{{route('user.show',['user'=>$recipes[0]['user_id']])}}" style="max-width:80px;">
                            <div  class="ratio ratio-1x1">
                                @if($recipes[0]['user']['icon']===null)<!-- もしアイコンが設定されていなければデフォルトのアイコンを表示 -->
                                    <img class="rounded-circle" src="{{asset('download20231202123050.png') }}">
                                @else
                                    <img class="rounded-circle" src="{{asset('storage/' . $recipes[0]['user']['icon']) }}">
                                @endif
                            </div>
                            <p class="my-auto">{{$recipes[0]['user']['name']}}</p>
                        </a>
                    </div>
                    </div>
                    <div class="col-8 my-auto d-flex justify-content-end">
                    @can('general')
                        @if(in_array($recipes[0]['id'],$mylikes))<!-- いいね機能 -->
                        <a href="{{ route('remove_like',['recipe'=>$recipes[0]['id']])}}" class="btn btn-outline-danger btn-sm">
                            お気に入り解除
                            <span class="badge" style="max-width:40px;"><img src="{{asset('ハートのアイコン素材 1.png') }}" style="object-fit: cover;" class="img-fluid"></span>{{count($recipes[0]['likes'])}}
                        </a>
                        @else
                        <a href="{{ route('add_like',['recipe'=>$recipes[0]['id']])}}" class="btn btn-outline-primary btn-sm">
                            お気に入り登録
                            <span class="badge" style="max-width:40px;"><img src="{{asset('ハートのアイコン素材 1 (1).png') }}" style="object-fit: cover;" class="img-fluid"></span>{{count($recipes[0]['likes'])}}
                        </a>
                        @endif
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
                <div class="card">
                    <div class="card-title">ひとことメモ</div>
                    <div class="card-body">
                        <p>{{$recipes[0]['memo']}}</p>
                    </div>
                </div>
            </div>
        <div class="card-body">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>材料({{$recipes[0]['serve']}}人分)</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach($recipes[0]['ingredients'] as $ingredient)
                        <tr>
                            <td>{{$ingredient['name']}}</td>
                            <td>{{$ingredient['quantity']}}</td>
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
                        <div class="col-4">
                            <div class="ratio ratio-16x9">
                                <img src="{{asset('storage/' . $step['sub_image']) }}" class="img-fluid rounded-start" style="object-fit: cover;">
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="card-body">
                                <p class="card-text">{{$step['procedure']}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="card-body">
            <div class="card">
                <h5 class="card-title text-center">コメント一覧</h5>
                @if(!empty($comments))
                    @foreach($comments as $comment)
                        <div class="card-body">
                            <div class="row">
                                @if($loop->index!=3)
                                    <div class="col-2" style="max-width:80px;">
                                        <div class="ratio ratio-1x1">
                                            @if(is_null($comment['user'][0]['icon']))
                                                <img class="rounded-circle" style="object-fit: cover;" src="{{asset('download20231202123050.png') }}">
                                            @else
                                                <img class="rounded-circle" style="object-fit: cover;" src="{{asset('storage/' . $comment['user'][0]['icon']) }}">
                                            @endif
                                        </div>
                                    </div>
                                    @if($comment['user'][0]['id']==$recipes[0]['user_id'])
                                    <div class="col-10 border border-dark rounded-3 p-2" style="background-color: #33FF00;">
                                    @else
                                    <div class="col-10 border border-dark rounded-3 p-2">
                                    @endif
                                        <p>{{$comment['comment']}}</p>
                                        <small>from&nbsp;{{$comment['user'][0]['name']}}</small>
                                        <div class="d-flex justify-content-end">
                                            @if($comment['user'][0]['id']==Auth::user()->id)
                                                <a href="{{route('comment.edit',['comment'=>$comment['id']])}}" class="btn btn-outline-primary btn-sm">編集</a>
                                                <form action="{{route('comment.destroy',['comment'=>$comment['id']])}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="submit" value="削除" class="btn btn-outline-danger btn-sm" onClick="delete_alert(event);return false;">
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                    <p class="text-end">{{substr($comment['created_at'],0,10)}}</p>
                                @elseif($loop->index==3)
                                    <a href="{{route('comment.show',['recipe'=>$recipes[0]['id']])}}">もっと見る</a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-center">コメントはありません</p>
                @endif
                @can('general')
                    <a href="{{route('comment_create',['recipe'=>$recipes[0]['id']])}}" class="btn btn-primary btn-sm col-4 mx-auto">コメントを投稿する</a>
                @endcan
            </div>
        </div>
    </div>
    <script>
        function delete_alert(e){
            if(!window.confirm('本当に削除しますか？')){
                window.alert('キャンセルされました');
                return false;
            }
            document.deleteform.submit();
        };
    </script>
@endsection