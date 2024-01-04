@extends('layouts.layout')
@section('content')
  {{Breadcrumbs::render('step.create')}}
  <div class="card border-light">
    <h4 class="card-title">手順登録</h4>
    <div class="card-body">
      <form action="{{route('step.store')}}" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
        @csrf
        <a onclick=add() class="btn btn-sm btn-light">+追加</a><!-- 項目を追加 -->
        <div id="input_plural">
          <div class="card-group">
            <div class="card">
              <lavel for='sub_image' class="form-label">サブ画像</lavel>
              <input type='file' name='sub_image[]' class="form-control fileInput" required accept="image/*">
              <div class="invalid-feedback">
                サブ画像の入力は必須です
              </div>
            </div>
            <div class="card">
              <lavel for='procedure' class="form-label">手順</lavel>
              <textarea name='procedure[]' class="form-control" required maxlength=255>{{old('procedure')}}</textarea>
              <div class="invalid-feedback">
                手順の入力は必須です
              </div>
            </div>
          </div>
        </div>
        <input type='submit' class="btn btn-primary">
        <a href="{{route('ingredient.create')}}" class="btn btn-outline-secondary">戻る</a>
      </form>
    </div>
  </div>

  <script>
    let inputPlural = document.getElementById('input_plural');
    var count = 1;

    function add() {
      let newDiv = document.createElement('DIV');
      newDiv.classList.add('card-group');
      newDiv.id = 'sub-plural';

      let div1 = document.createElement('DIV');
      div1.classList.add('card');
      newDiv.appendChild(div1);

      var input1 = document.createElement('INPUT');
      input1.setAttribute("type", "file");
      input1.classList.add('form-control');
      input1.classList.add("fileInput");
      input1.setAttribute('name', 'sub_image[]');
      input1.setAttribute('required', true);
      input1.setAttribute('accept', 'image/*');
      div1.appendChild(input1);

      let requred1 = document.createElement('DIV');
      requred1.classList.add('invalid-feedback');
      requred1.textContent = "サブ画像の入力は必須です。";
      div1.appendChild(requred1);

      let div2 = document.createElement('DIV');
      div2.classList.add('card');
      newDiv.appendChild(div2);

      var input2 = document.createElement('TEXTAREA');
      input2.classList.add('form-control');
      input2.setAttribute('name', 'procedure[]');
      input2.setAttribute('maxlength', 255);
      input2.setAttribute('required', true);
      div2.appendChild(input2);

      let requred2 = document.createElement('DIV');
      requred2.classList.add('invalid-feedback');
      requred2.textContent = "手順の入力は必須です。";
      div2.appendChild(requred2);

      var input = document.createElement('INPUT');
      input.setAttribute('type', 'button');
      input.setAttribute('value', '削除');
      input.setAttribute('onclick', 'del(this)');
      newDiv.appendChild(input);

      inputPlural.appendChild(newDiv);
      count++;
    }
    function del(o) {
      o.parentNode.remove();
    }

    (() => {
    'use strict'

    // Bootstrapカスタム検証スタイルを適用してすべてのフォームを取得
    const forms = document.querySelectorAll('.needs-validation')

    // ループして帰順を防ぐ
    Array.from(forms).forEach(form => {
      form.addEventListener('submit', event => {
        var inputs = document.getElementsByClassName('fileInput');
        for (var j = 0; j < inputs.length; j++) {
            var files = inputs[j].files;
            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                var maxSizeInBytes = 2097152;
                if (file.size > maxSizeInBytes) {
                  alert('2MB以内の画像を選択してください');
                    // フォームの送信を中止
                    event.preventDefault();
                    // ファイル選択をクリアして入力フィールドの値を空にする
                    inputs[j].value = '';
                }
            }
        }
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