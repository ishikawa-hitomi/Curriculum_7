@extends('layouts.layout')
@section('content')
  {{Breadcrumbs::render('ingredient.create')}}
  <div class="card border-light">
    <h4 class="card-title">材料・分量登録</h4>
    <div class="card-body">
      <form action="{{route('ingredient.store')}}" method="post" class="needs-validation" novalidate>
        @csrf
        <a onclick="add()" class="btn btn-sm btn-light">+追加</a><!-- 材料の数だけ項目を追加できる -->
        <div id="input_plural">
          @if(!empty($session))
            @for($a=0;$a<=count($session['name'])-1;$a++)
              @if($a == 0)<!-- 最初のループでは削除ボタンを表示しない -->
                <div class="card-group">
                  <div class="card">
                    <lavel for='name' class="form-label">材料</lavel>
                    <input type='text' name='name[]' class="form-control" value="{{$session['name'][$a]}}" placeholder="卵" maxlength=15 required>
                    <div class="invalid-feedback">
                      材料の入力は必須です
                    </div>
                  </div>
                  <div class="card">
                    <lavel for='quantity' class="form-label">分量</lavel>
                    <input type='text' name='quantity[]' class="form-control" value="{{$session['quantity'][$a]}}" placeholder="1個" maxlength=10 required>
                    <div class="invalid-feedback">
                      分量の入力は必須です
                    </div>
                  </div>
                </div>
              @else
                <div class="card-group">
                  <div class="card">
                    <input type='text' name='name[]' class="form-control" value="{{$session['name'][$a]}}" placeholder="卵" maxlength=15 required>
                    <div class="invalid-feedback">
                      材料の入力は必須です
                    </div>
                  </div>
                  <div class="card">
                    <input type='text' name='quantity[]' class="form-control" value="{{$session['quantity'][$a]}}" placeholder="1個" maxlength=10 required>
                    <div class="invalid-feedback">
                      分量の入力は必須です
                    </div>
                  </div>
                  <input type="button" value="削除" onclick="del(this)"><!-- 項目を削除 -->
                </div>
              @endif
            @endfor
          @else
            <div class="card-group">
              <div class="card">
                <lavel for='name' class="form-label">材料</lavel>
                <input type='text' name='name[]' class="form-control" value="{{old('name')}}" placeholder="卵" maxlength=15 required>
                <div class="invalid-feedback">
                  材料の入力は必須です
                </div>
              </div>
              <div class="card">
              <lavel for='quantity' class="form-label">分量</lavel>
                <input type='text' name='quantity[]' class="form-control" value="{{old('quantity')}}" placeholder="1個" maxlength=10 required>
                <div class="invalid-feedback">
                  分量の入力は必須です
                </div>
              </div>
            </div>
          @endif
        </div>
        <input type='submit' class="btn btn-primary">
        <a href="{{route('recipe.create')}}" class="btn btn-outline-secondary">戻る</a>
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
      input1.classList.add('form-control');
      input1.setAttribute('name', 'name[]');
      input1.setAttribute('maxlength', 15);
      input1.setAttribute('required', true);
      div1.appendChild(input1);

      let requred1 = document.createElement('DIV');
      requred1.classList.add('invalid-feedback');
      requred1.textContent = "材料の入力は必須です。";
      div1.appendChild(requred1);

      let div2 = document.createElement('DIV');
      div2.classList.add('card');
      newDiv.appendChild(div2);

      var input2 = document.createElement('INPUT');
      input2.classList.add('form-control');
      input2.setAttribute('name', 'quantity[]');
      input2.setAttribute('maxlength', 10);
      input2.setAttribute('required', true);
      div2.appendChild(input2);

      let requred2 = document.createElement('DIV');
      requred2.classList.add('invalid-feedback');
      requred2.textContent = "分量の入力は必須です。";
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