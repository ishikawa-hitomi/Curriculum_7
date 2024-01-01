@extends('layouts.layout')
@section('content')
  {{Breadcrumbs::render('user.profile_edit',$users[0]['id'])}}
  @foreach($users as $user)
  <div class="cardb border-light">
    <h4 class="card-title">プロフィール情報変更</h4>
    <div class="card-body">
      <form action="{{route('user.profile_update',['user'=>$user['id']])}}" method="post" enctype="multipart/form-data">
        @csrf
        <lavel for='icon' class="form-label">ユーザーアイコン</lavel>
          <input type='file' name='icon' class="form-control" id="fileInput">
        <lavel for='profile' class="form-label">プロフィール</lavel>
          <textarea name='profile' class="form-control">{{$user['profile']}}</textarea>
        <input type='submit' class="btn btn-primary">
      </form>
    </div>
  </div>
  @endforeach

  <script>
    //ファイルサイズのバリデーション
    $(document).ready(function(){
    $('#fileInput').change(function(){
      var fileSize=this.files[0].size;
      var maxSizeInBytes=2097152;
      if(fileSize>maxSizeInBytes){
        alert('2MB以内の画像を選択してください');
        $(this).val('');
      }
    });
    });
  </script>
@endsection