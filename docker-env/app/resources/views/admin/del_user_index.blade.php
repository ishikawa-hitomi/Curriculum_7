@extends('layouts.layout')
@section('content')
  <div class="card">
    <div>
      <form action="{{route('admin.del_user_index')}}" method="GET">
        <div>
          <label name="user_id" class="form-label">ID</label>
          <input type="number" name="user_id" class="form-control form-control-sm" value="{{e(request()->input('user_id'))}}"></div>
        <div>
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
    <a href="{{route('admin.user_index')}}" class="nav-link">ユーザー一覧</a>
      <a class="nav-link active">削除済みユーザー一覧</a>
    </div>
    <div class="card-body">
      <div class="row">
        <table class="table table-bordered">
        <thead>
                <tr>
                  <th scope="col">@sortablelink('id', 'ID')</th>
                  <th scope="col">@sortablelink('name', '名前')</th>
                  <th scope="col">@sortablelink('deleted_at', '削除日')</th>
                  <th scope="col">経過日数</th>
                  <th scope="col">復元申請</th>
                  <th scope="col"></th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                @if($del_users==null)
                  <br><strong>一致する検索結果はありません</strong>
                @endif
                @foreach($del_users as $user)
                  <tr>
                    <th scope="row">{{$user['id']}}</th>
                    <td>{{$user['name']}}</td>
                    <td>{{substr($user['deleted_at'],0,10)}}</td>
                    <td>{{$now->diffInDays($user['deleted_at'])}}日</td>
                    <td>
                      @foreach($inquiry as $val)
                        @if($user['name']==$val['user_name']&&$user['email']==$val['user_email']||$user['password']==$val['user_pass'])
                        <strong class="text-danger">済</strong>
                        @endif
                      @endforeach
                    </td>
                    <td><form action="{{route('admin.del_user_index')}}" methd="post">@csrf<input type="hidden" name="restore" value="{{$user['id']}}"><input type="submit" class="btn btn-primary" value="復元" onClick="restore_prompt();return false;"></form></td>
                    <td><form action="{{route('admin.del_user_index')}}" methd="post">@csrf<input type="hidden" name="forceDelete" value="{{$user['id']}}"><input type="submit" class="btn btn-danger" value="完全削除" onClick="delete_prompt();return false;"></form></td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            *30日経過したユーザーは自動的に削除
            <br>*復元申請があったユーザーは手動で復元
      </div>
    </div>
  </div>
  <script>
    function restore_prompt(){
      var Input=window.prompt("本当に復元しますか？復元する場合はパスワードを入力してください。","");
      if(Input=="{{$pass}}"){
        document.deleteform.submit();
      }else{
        window.alert('キャンセルされました');
        return false;
      }
    };
    function delete_prompt(){
      var Input=window.prompt("本当に削除しますか？削除する場合はパスワードを入力してください。","");
      if(Input=="{{$pass}}"){
        document.deleteform.submit();
      }else{
        window.alert('キャンセルされました');
        return false;
      }
    };
  </script>
@endsection