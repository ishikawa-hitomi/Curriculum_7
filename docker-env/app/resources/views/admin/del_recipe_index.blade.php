@extends('layouts.layout')
@section('content')
  <div class="card">
    <div>
      <form action="{{route('admin.del_recipe_index')}}" method="GET">
        <div>
          <label name="id" class="form-label">ID</label>
          <input type="number" name="id" class="form-control form-control-sm" value="{{e(request()->input('id'))}}">
        </div>
        <div>
          <label name="user_id" class="form-label">投稿者ID</label>
          <input type="text" name="user_id" class="form-control form-control-sm" value="{{(e(request()->input('user_id')))}}">
        </div>
        <div>
          <label name="display_title" class="form-label">表示用タイトル</label>
          <input type="text" name="display_title" class="form-control form-control-sm" value="{{e(request()->input('display_title'))}}">
        </div>
        <div>
          <label name="title" class="form-label">料理名</label>
          <input type="text" name="title" class="form-control form-control-sm" value="{{e(request()->input('title'))}}">
        </div>
        <div>
          <label name="date" class="form-label">削除日</label>
          <input type="date" name="from" class="form-control form-control-sm" value="{{e(request()->input('from'))}}">
          -
          <input type="date" name="to" class="form-control form-control-sm" value="{{e(request()->input('to'))}}">
        </div>
        <input type="submit" value="検索">
      </form>
    </div>
    <div class="nav nav-tabs">
      <a href="{{route('admin.recipe_index')}}" class="nav-link">レシピ一覧</a>
      <a class="nav-link active">削除済みレシピ一覧</a>
    </div>
    <div class="card-body">
      <div class="row">
        *30日経過したレシピは自動的に削除
        <br>*見出しクリックでソート可能
        <table class="table table-bordered">
          <thead>
            <tr>
              <th scope="col">@sortablelink('id', 'ID')</th>
              <th scope="col">@sortablelink('user_id', '投稿者ID')</th>
              <th scope="col">@sortablelink('display_title', '表示用タイトル')</th>
              <th scope="col">@sortablelink('title', '料理名')</th>
              <th scope="col">@sortablelink('deleted_at', '削除日')</th>
              <th scope="col">経過日数</th>
              <th scope="col"></th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            @if($del_recipes==null)
              <br><strong>一致する検索結果はありません</strong>
            @endif
              @foreach($del_recipes as $recipe)
                <tr>
                  <th scope="row">{{$recipe['id']}}</th>
                  <td>{{$recipe['user_id']}}<br>(@if($recipe['user']==null)削除済み@else {{$recipe['user']['name']}}@endif)</td>
                  <td>{{$recipe['display_title']}}</td>
                  <td>{{$recipe['title']}}</td>
                  <td>{{substr($recipe['deleted_at'],0,10)}}</td>
                  <td>{{$now->diffInDays($recipe['deleted_at'])}}日</td>
                  <td><form action="{{route('admin.del_recipe_index')}}" methd="post">@csrf<input type="hidden" name="restore" value="{{$recipe['id']}}"><input type="submit" class="btn btn-primary" value="復元"></form></td>
                  <td><form action="{{route('admin.del_recipe_index')}}" methd="post">@csrf<input type="hidden" name="forceDelete" value="{{$recipe['id']}}"><input type="submit" class="btn btn-danger" value="完全削除" onClick="delete_alert(event);return false;"></form></td>
                </tr>
              @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <script>
    function delete_alert(e){
      if(!window.confirm('データが完全に削除されます。本当に削除しますか？')){
        window.alert('キャンセルされました');
        return false;
      }
      document.deleteform.submit();
    };
  </script>
@endsection