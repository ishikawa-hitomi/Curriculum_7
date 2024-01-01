@extends('layouts.layout')
@section('content')
  {{Breadcrumbs::render('user.pass_edit',$users[0]['id'])}}
  <div class="cardb border-light">
    @foreach($users as $user)
      <div class="card-body">
        @if(session()->has('pass_edit_message'))
          <div class="alert alert-danger" role="alert">
            {{session()->pull('pass_edit_message')}}
          </div>
        @endif
        <form action="{{route('user.pass_update',['user'=>Auth::user()->id])}}" method="post" class="needs-validation" novalidate>
          @csrf
          <div>
            <lavel for='now_password' class="form-label">現在のパスワード</lavel>
            <input type='password' name='now_password' value="" class="form-control" minlength=8 required>
            <div class="invalid-feedback">
                現在のパスワードの入力は必須です
            </div>
          </div>
          <div>
            <lavel for='password' class="form-label">新しいパスワード</lavel>
            <input type='password' name='password' value="" class="form-control" minlength=8 required>
            <div class="invalid-feedback">
                新しいパスワードの入力は必須です
            </div>
          </div>
          <div>
            <lavel for='conf_password' class="form-label">新しいパスワード（確認）</lavel>
            <input type='password' name='conf_password' value="" class="form-control" minlength=8 required>
            <div class="invalid-feedback">
                新しいパスワード（確認）の入力は必須です
            </div>
          </div>
          <input type='submit' class="btn btn-primary">
        </form>
        <a href="{{route('user.edit',['user'=>$user['id']])}}">戻る</a>
      </div>
    @endforeach
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