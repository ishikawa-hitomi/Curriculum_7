@extends('layouts.layout')
@section('content')
  <div class="card">
    <h4 class="card-title">新規投稿</h4>
    <div class="card-body">
      <form action="{{route('recipe.store')}}" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
        @csrf
        <div>
          <lavel for='main_image' class="form-label">メイン画像</lavel>
          <input type='file' name='main_image' class="form-control" required accept="image/*">
          <div class="invalid-feedback">
            サムネイルに使用するメイン画像登録は必須です
          </div>
        </div>
        <div>
          <lavel for='display_title' class="form-label">表示用タイトル</lavel>
          <input type='text' name='display_title' class="form-control" value="{{old('display_title')}}"placeholder="卵を使用しないで作れる！簡単ふわふわスフレパンケーキ" required>
          <div class="invalid-feedback">
            表示用タイトルの入力は必須です
          </div>
        </div>
        <div>
          <lavel for='title' lass="form-label">料理名</lavel>
          <input type='text' name='title' class="form-control" value="{{old('title')}}" placeholder="パンケーキ" required>
          <div class="invalid-feedback">
            料理名の入力は必須です
          </div>
        </div>
        <div>
          <lavel for='time' lass="form-label">調理時間目安</lavel>
          <input type='number' name='time' class="form-control" value="{{old('time')}}" required>
          <div class="invalid-feedback">
            調理目安時間の入力は必須です
          </div>
        </div>
        <div>
          <lavel for='serve' lass="form-label">人数目安</lavel>
          <input type='number' name='serve' class="form-control" value="{{old('serve')}}" required>
          <div class="invalid-feedback">
            人数目安の入力は必須です
          </div>
        </div>
        <div>
          <lavel for='tag_id' lass="form-label">タグ</lavel>
          <select name='tag_id' class="form-select" required>
          <option value="" disabled selected>タグを選択してください</option>
            @foreach($tags as $tag)
            <option value="{{$tag['id']}}">{{$tag['name']}}</option>
            @endforeach
          </select>
          <div class="invalid-feedback">
            タグの選択は必須です
          </div>
          <a href="{{route('tag_create')}}">タグの追加</a>
        </div>
        <div>
          <lavel for='memo' lass="form-label">メモ</lavel>
          <textarea name='memo' class="form-control">{{old('memo')}}</textarea>
        </div>
        <input type='submit' class="btn btn-primary">
      </form>
    </div>
  </div>
  <script>
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
</script>
@endsection