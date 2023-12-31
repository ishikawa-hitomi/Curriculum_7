@extends('layouts.layout')
@section('content')
  @foreach($recipes as $recipe)
    <div class="card-body">
      <form action="{{route('recipe.update',['recipe'=>$recipe['id']])}}" method="post" class="was-validated" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div>
          <lavel for='main_image' class="form-label">メイン画像</lavel>
          <input type='file' name='main_image' class="form-control" accept="image/*" id="fileInput">
        </div>
        <div>
          <lavel for='display_title' class="form-label">表示用タイトル</lavel>
          <input type='text' name='display_title' class="form-control" value="{{$recipe['display_title']}}"placeholder="卵を使用しないで作れる！簡単ふわふわスフレパンケーキ" required>
          <div class="invalid-feedback">
            表示用のタイトル入力は必須です
          </div>
        </div>
        <div>
          <lavel for='title' lass="form-label">料理名</lavel>
          <input type='text' name='title' class="form-control" value="{{$recipe['title']}}" placeholder="パンケーキ" required>
          <div class="invalid-feedback">
            料理名入力は必須です
          </div>
        </div>
        <div>
          <lavel for='time' lass="form-label">調理時間目安</lavel>
          <input type='number' name='time' class="form-control" value="{{$recipe['time']}}" required>
          <div class="invalid-feedback">
            調理の目安時間入力は必須です
          </div>
        </div>
        <div>
          <lavel for='serve' lass="form-label">人数目安</lavel>
          <input type='number' name='serve' class="form-control" value="{{$recipe['serve']}}" required>
          <div class="invalid-feedback">
            人数の目安入力は必須です
          </div>
        </div>
        <div>
          <lavel for='tag_id' lass="form-label">タグ</lavel>
          <div class="row row-cols-4">
            @foreach($tags as $tag)
              <div class="col">
                <input type="checkbox" name="tag_id[]" value="{{$tag['id']}}" @if($recipe['tag_id_1']==$tag['id']||$recipe['tag_id_2']==$tag['id']||$recipe['tag_id_3']==$tag['id']||$recipe['tag_id_4']==$tag['id']||$recipe['tag_id_5']==$tag['id']) checked @endif>{{$tag['name']}}
              </div>
            @endforeach
          </div>
          <div class="invalid-feedback">
            タグ選択は必須です
          </div>
          <a href="{{route('tag_create')}}">タグの追加</a>
        </div>
        <div>
          <lavel for='memo' lass="form-label">メモ</lavel>
          <textarea name='memo' class="form-control" maxlength=255>{{$recipe['memo']}}</textarea>
        </div>
        <input type='submit' class="btn btn-primary">
      </form>
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

    const maxChecks = 5;
    const minChecks = 0;
    const checkboxes = document.querySelectorAll('input[name="tag_id[]"]');
    checkboxes.forEach((checkbox) => {
      checkbox.addEventListener('change', () => {
        const checkedCheckboxes = document.querySelectorAll('input[name="tag_id[]"]:checked');
        if (checkedCheckboxes.length >= maxChecks) {
          checkboxes.forEach((cb) => {
            if (!cb.checked) {
              cb.disabled = true;
            }
          });
        } else {
          checkboxes.forEach((cb) => {
            cb.disabled = false;
          });
        }
        if (checkedCheckboxes.length > minChecks) {
          checkboxes.forEach((cb) => {
            cb.required = false;
          });
        }else{
          checkboxes.forEach((cb) => {
            if (!cb.checked) {
              cb.required = true;
            }
          });
        }
      });
    });
  </script>
@endsection