@extends('layouts.layout')
@section('content')
  <div class="card">
    <h4 class="card-title">新規投稿</h4>
    <div class="card-body">
      <form action="{{route('recipe.store')}}" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
        @csrf
        <div>
          <lavel for='main_image' class="form-label">メイン画像</lavel>
          <input type='file' name='main_image' class="form-control" accept="image/*" required id="fileInput">
          <div class="invalid-feedback">
            サムネイルに使用するメイン画像登録は必須です
          </div>
        </div>
        <div>
          <lavel for='display_title' class="form-label">表示用タイトル</lavel>
          <input type='text' name='display_title' class="form-control" @if(!empty($session['display_title'])) value="{{$session['display_title']}}"@endif placeholder="卵を使用しないで作れる！簡単ふわふわスフレパンケーキ" maxlength=40 required>
          <div class="invalid-feedback">
            表示用タイトルの入力は必須です
          </div>
        </div>
        <div>
          <lavel for='title' lass="form-label">料理名</lavel>
          <input type='text' name='title' class="form-control" @if(!empty($session['title'])) value="{{$session['title']}}"@endif placeholder="パンケーキ" maxlength=20 required>
          <div class="invalid-feedback">
            料理名の入力は必須です
          </div>
        </div>
        <div>
          <lavel for='time' lass="form-label">調理時間目安</lavel>
          <input type='number' name='time' class="form-control" @if(!empty($session['time'])) value="{{$session['time']}}"@endif min=1 required>
          <div class="invalid-feedback">
            調理目安時間の入力は必須です
          </div>
        </div>
        <div>
          <lavel for='serve' lass="form-label">人数目安</lavel>
          <input type='number' name='serve' class="form-control" @if(!empty($session['serve'])) value="{{$session['serve']}}"@endif min=1 required>
          <div class="invalid-feedback">
            人数目安の入力は必須です
          </div>
        </div>
        <div>
          <lavel for='tag_id' lass="form-label">タグ</lavel>
          <div class="row row-cols-4">
            @foreach($tags as $tag)
              <div class="col">
                <input type="checkbox" name="tag_id[]" value="{{$tag['id']}}" @if(!empty($session['tag_id'])&&$session['tag_id']==$tag['id']) checked @elseif(!empty($session['tag_id'])&&$session['tag_id']!=$tag['id']) disabled @elseif(empty($session['tag_id'])) required @endif>{{$tag['name']}}
              </div>
            @endforeach
          </div>
          <div class="invalid-feedback">
            タグの選択は必須です
          </div>
          <a href="{{route('tag_create')}}">タグの追加</a>
        </div>
        <div>
          <lavel for='memo' lass="form-label">メモ</lavel>
          <textarea name='memo' class="form-control" maxlength=255>@if($session!='') {{$session['memo']}} @endif</textarea>
        </div>
        <input type='submit' class="btn btn-primary">
      </form>
    </div>
  </div>
  <script>
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

    // 無効なフィールドがある場合にフォーム送信を無効にするスターターJavaScriptの例
    (() => {
      'use strict'

    // Bootstrapカスタム検証スタイルを適用してすべてのフォームを取得
    const forms = document.querySelectorAll('.needs-validation')

    // ループして帰順を防ぐ
    Array.from(forms).forEach(form => {
      form.addEventListener('submit', event => {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
    })()

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