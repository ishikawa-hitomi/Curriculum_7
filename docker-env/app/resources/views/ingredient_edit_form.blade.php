@extends('layouts.layout')
@section('content')
  <div class="card">
    <h4 class="card-title">材料・分量登録</h4>
    <div class="card-body">
        <form action="{{route('ingredient_edit',['recipe'=>$recipeid])}}" method="post" class="was-validated" novalidate>
        @csrf
        <a onclick="add()" class="btn btn-sm btn-light">+追加</a>
        <div id="input_plural">
          @foreach($recipes as $recipe)
            <div class="card-group">
              <div class="card">
                <lavel for='name' class="form-label">材料</lavel>
                <input type='text' name='name[]' class="form-control" value="{{$recipe['name']}}" placeholder="卵" required>
                <div class="invalid-feedback">
                  材料の入力は必須です
                </div>
              </div>
              <div class="card">
              <lavel for='quantity' class="form-label">材料</lavel>
                <input type='text' name='quantity[]' class="form-control" value="{{$recipe['quantity']}}" placeholder="1個" required>
                <div class="invalid-feedback">
                  分量の入力は必須です
                </div>
              </div>
            </div>
          @endforeach
        </div>
        <div>
          <input type='hidden' name='recipe_id' class="form-control" value="{{$recipeid}}" required>
        </div>
        <input type='submit' class="btn btn-primary">
      </form>
    </div>
  </div>

  <script>
    let inputPlural = document.getElementById('input_plural');
    var count = 2;

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
      div1.appendChild(input1);

      let div2 = document.createElement('DIV');
      div2.classList.add('card');
      newDiv.appendChild(div2);

      var input2 = document.createElement('INPUT');
      input2.classList.add('form-control');
      input2.setAttribute('name', 'quantity[]');
      div2.appendChild(input2);

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
  </script>
@endsection