@extends('layouts.layout')
@section('content')
  <div class="card">
    <h4 class="card-title">手順編集</h4>
    <div class="card-body">
      <form action="{{route('step.update',['recipe'=>$recipeId])}}" method="post" class="was-validated" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <a onclick=add() class="btn btn-sm btn-light">+追加</a><!-- 項目を追加 -->
        <div id="input_plural">
          @foreach($steps as $step)
            @if($step === reset($steps))<!-- 最初のループでは削除ボタンを表示しない -->
              <div class="card-group">
                <div class="card">
                  <lavel for='sub_image' class="form-label">サブ画像</lavel>
                  <input type='file' name='sub_image[]' class="form-control" required accept="image/*" id="fileInput">
                  <div class="invalid-feedback">
                    サブ画像の入力は必須です
                  </div>
                </div>
                <div class="card">
                  <lavel for='procedure' class="form-label">手順</lavel>
                  <textarea name='procedure[]' class="form-control" maxlength=255 required>{{$step['procedure']}}</textarea>
                  <div class="invalid-feedback">
                    手順の入力は必須です
                  </div>
                </div>
              </div>
            @else
              <div class="card-group">
                <div class="card">
                  <input type='file' name='sub_image[]' class="form-control" required accept="image/*" id="fileInput">
                  <div class="invalid-feedback">
                    サブ画像の入力は必須です
                  </div>
                </div>
                <div class="card">
                  <textarea name='procedure[]' class="form-control" required>{{$step['procedure']}}</textarea>
                  <div class="invalid-feedback">
                    手順の入力は必須です
                  </div>
                </div>
                <input type="button" value="削除" onclick="del(this)"><!-- 項目を削除 -->
              </div>
            @endif
          @endforeach
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
    var count = 2;

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
      input1.setAttribute('name', 'sub_image[]');
      input1.setAttribute('required', true);
      div1.appendChild(input1);

      let requred1 = document.createElement('DIV');
      requred1.classList.add('invalid-feedback');
      requred1.textContent = "サブ画像の入力は必須です。";
      div1.appendChild(requred1);

      let div2 = document.createElement('DIV');
      div2.classList.add('card');
      newDiv.appendChild(div2);

      var input2 = document.createElement('textarea');
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