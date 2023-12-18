@extends('layouts.layout')
@section('content')
  <div class="card">
    <div>
      <form action="{{route('admin.recipe_index')}}" method="GET">
        <div>
          <label name="id" class="form-label">ID</label>
          <input type="number" name="id" class="form-control form-control-sm" value="{{e(request()->input('id'))}}">
        </div>
        <div>
          <label name="user_id" class="form-label">投稿者ID
          </label>
          <input type="number" name="user_id" class="form-control form-control-sm" value="{{e(request()->input('user_id'))}}">
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
          <label name="date" class="form-label">作成日</label>
          <input type="date" name="from" class="form-control form-control-sm" value="{{e(request()->input('from'))}}">
          -
          <input type="date" name="to" class="form-control form-control-sm" value="{{e(request()->input('to'))}}">
        </div>
        <input type="submit" value="検索">
      </form>
    </div>
    <div class="nav nav-tabs">
      <a class="nav-link active">レシピ一覧</a>
      <a href="{{route('admin.del_recipe_index')}}" class="nav-link">削除済みレシピ一覧</a>
    </div>
    <div class="card-body">
      <div class="row">
        *見出しクリックでソート可能
        <table class="table table-bordered">
          <thead>
            <tr>
              <th scope="col">@sortablelink('id', 'ID')</th>
              <th scope="col">@sortablelink('user_id', '投稿者ID')</th>
              <th scope="col">@sortablelink('display_title', '表示用タイトル')</th>
              <th scope="col">@sortablelink('title', '料理名')</th>
              <th scope="col">@sortablelink('created_at', '作成日')</th>
              <th scope="col">いいね数</th>
              <th scope="col">コメント数</th>
              <th scope="col">詳細</th>
            </tr>
          </thead>
          <tbody>
            @if($recipes==null)
              <br><strong>一致する検索結果はありません</strong>
            @endif
              @foreach($recipes as $recipe)
                <tr>
                  <th scope="row">{{$recipe['id']}}</th>
                  <td>{{$recipe['user_id']}}<br>({{$recipe['user']['name']}})</td>
                  <td>{{e($recipe['display_title'])}}</td>
                  <td>{{$recipe['title']}}</td>
                  <td>{{substr($recipe['created_at'],0,10)}}</td>
                  <td>{{count($recipe['likes'])}}</td>
                  <td>{{count($recipe['comments'])}}</td>
                  <td><a class="btn btn-primary" role="button" href="{{route('recipe.show',['recipe'=>$recipe['id']])}}">詳細</a></td>
                </tr>
              @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection