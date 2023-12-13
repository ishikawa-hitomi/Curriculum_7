@extends('layouts.layout')
@section('content')
  <div class="card">
    <h4 class="card-title">材料・分量登録</h4>
    <div class="card-body">
      <form action="{{route('ingredient_create',['recipe'=>$recipeId])}}" method="post" class="needs-validation" novalidate>
        @csrf
        <a onclick="add()" class="btn btn-sm btn-light">+追加</a>
        <div id="input_plural">
          <div class="card-group">
            <div class="card">
              <lavel for='name' class="form-label">材料</lavel>
              <input type='text' name='name[]' class="form-control" value="{{old('name')}}" placeholder="卵" required>
              <div class="invalid-feedback">
                材料の入力は必須です
              </div>
            </div>
            <div class="card">
            <lavel for='quantity' class="form-label">材料</lavel>
              <input type='text' name='quantity[]' class="form-control" value="{{old('quantity')}}" placeholder="1個" required>
              <div class="invalid-feedback">
                分量の入力は必須です
              </div>
            </div>
          </div>
        </div>
        <div>
          <input type='hidden' name='recipe_id' class="form-control" value="{{$recipeId}}" required>
        </div>
        <input type='submit' class="btn btn-primary">
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