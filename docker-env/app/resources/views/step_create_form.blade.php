@extends('layouts.layout')
@section('content')
  <div class="card">
    <h4 class="card-title">手順登録</h4>
    @if($errors->any())
      <ul>
        @foreach($errors->all() as $message)
          <li>{{$message}}</li>
        @endforeach
      </ul>
    @endif
    <div class="card-body">
      @foreach($recipes as $recipe)
      <form action="{{route('step_create',['recipe'=>$recipe['id']])}}" method="post" class="was-validated" novalidate enctype="multipart/form-data">
        @csrf
        <a onclick=add() class="btn btn-sm btn-light">+追加</a>
        <div id="input_plural">
          <div class="card-group">
            <div class="card">
              <lavel for='name' class="form-label">サブ画像</lavel>
              <input type='file' name='sub_image' class="form-control" required accept="image/*">
              <div class="invalid-feedback">
                材料の入力は必須です
              </div>
            </div>
            <div class="card">
              <lavel for='procedure' class="form-label">手順</lavel>
              <textarea name='procedure' class="form-control" required>{{old('procedure')}}</textarea>
              <div class="invalid-feedback">
                分量の入力は必須です
              </div>
            </div>
          </div>
        </div>
        <div>
          <input type='hidden' name='recipe_id' class="form-control" value="{{$recipe['id']}}" required>
        </div>
        <input type='submit' class="btn btn-primary">
      </form>
      @endforeach
    </div>
  </div>

  <!--
    <script>
    let inputPlural = document.getElementById('input_plural');
    var count = 2;

    function add() {
      let div = document.createElement('DIV');
      div.classList.add('d-flex');

      var input = document.createElement('INPUT');
      input.classList.add('form-control');
      input.setAttribute('name', 'name[]');
      div.appendChild(input);

      var input = document.createElement('INPUT');
      input.classList.add('form-control');
      input.setAttribute('name', 'quantity[]');
      div.appendChild(input);

      var input = document.createElement('INPUT');
      input.setAttribute('type', 'button');
      input.setAttribute('value', '削除');
      input.setAttribute('onclick', 'del(this)');
      div.appendChild(input);

      inputPlural.appendChild(div);
      count++;
    }

    function addd() {
      let div = document.createElement('DIV');
      div.classList.add('d-flex');

      var input = document.createElement('INPUT');
      input.classList.add('form-control');
      input.setAttribute('name', 'name'+count);
      div.appendChild(input);

      var input = document.createElement('INPUT');
      input.classList.add('form-control');
      input.setAttribute('name', 'quantity'+count);
      div.appendChild(input);

      var input = document.createElement('INPUT');
      input.setAttribute('type', 'button');
      input.setAttribute('value', '削除');
      input.setAttribute('onclick', 'del(this)');
      div.appendChild(input);

      inputPlural.appendChild(div);
      count++;
    }

    function del(o) {
      o.parentNode.remove();
    }
  </script>
  -->
@endsection