@extends('layouts.layout')
@section('content')
<div class="card">
    @foreach($comments as $comment)
      <div class="card-body">
        <div class="row">
          <div class="col-2" style="max-width:80px;">
            <div class="ratio ratio-1x1">
              @if(is_null($comment['user'][0]['icon']))
                <img class="rounded-circle" style="object-fit: cover;" src="{{asset('download20231202123050.png') }}">
              @else
                <img class="rounded-circle" style="object-fit: cover;" src="{{asset('storage/' . $comment['user'][0]['icon']) }}">
              @endif
            </div>
          </div>
          <div class="col-10 border border-dark rounded-3 p-2">
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
        </div>
      </div>
    @endforeach
    @can('general')
      <a href="{{route('comment_create',['recipe'=>$comments[0]['recipe_id']])}}" class="btn btn-primary btn-sm col-4 mx-auto">コメントを投稿する</a>
    @endcan
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