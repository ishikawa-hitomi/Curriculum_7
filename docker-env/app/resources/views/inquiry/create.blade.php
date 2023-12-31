@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card border-light">
          <ul class="nav">
            <li class="nav-item"><a class="nav-link" href="{{route('inquiry.index')}}">Q&A</a></li>
            <li class="nav-item"><a class="nav-link disabled">お問い合わせ</a></li>
          </ul>
          <div class="row">
            <div class="col">
              <div class="card m-2">
                <h5>お問い合せフォーム</h5>
                <div class="card-body">
                  <form action="{{route('inquiry.store')}}" method="POST">
                    @csrf
                    <div>
                      <label for="email">メールアドレス</label>
                      <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="l-wrap">
                      <div>
                        <label for="category">お問い合わせカテゴリ</label>
                        <select name="category" class="form-control" required id="select">
                          <option selected disabled style="display:none;" value="0">カテゴリーを選択してください</option>
                          <option value="1">質問</option>
                          <option value="2">ユーザーの復元</option>
                          <option value="3">レシピの復元</option>
                        </select>
                      </div>
                      <div id="1">
                        <div>
                          <label for="question">お問い合わせ内容</label>
                          <textarea name="question" class="form-control i1" required></textarea>
                        </div>
                      </div>
                      <div id="2">
                        <div>
                          <label for="re_user_name">ユーザー名</label>
                          <input type="text" name="user_name" class="form-control i2" required>
                        </div>
                        <div>
                          <label for="re_user_email">メールアドレス</label>
                          <input type="mail" name="user_email" class="form-control i2" required>
                        </div>
                        <div>
                          <label for="re_user_pass">パスワード</label>
                          <input type="password" name="user_pass" class="form-control i2" required>
                        </div>
                      </div>
                      <div id="3">
                        <div>
                          <label for="re_user_name">ユーザー名</label>
                          <input type="text" name="user_name" class="form-control i3" required>
                        </div>
                        <div>
                          <label for="re_user_email">メールアドレス</label>
                          <input type="mail" name="user_email" class="form-control i3" required>
                        </div>
                        <div>
                          <label for="re_user_pass">パスワード</label>
                          <input type="password" name="user_pass" class="form-control i3" required>
                        </div>
                        <div>
                          <label for="re_user_name">表示用タイトル
                          </label>
                          <input type="text" name="recipe_display" class="form-control i3" required>
                        </div>
                        <div>
                          <label for="re_user_name">料理名</label>
                          <input type="text" name="recipe_title" class="form-control i3" required>
                        </div>
                      </div>
                    </div>
                    <input type="submit" class="btn btn-primary">
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function() {
      if ($('#select option:selected').val() == '0') {
        $('#1').hide();
        $('#2').hide();
        $('#3').hide();
      }
      $('#select').on('change', function () {
        if ($('#select option:selected').val() == '1') {
          $('#1').show();
          $('.i1').prop("required",true);
        } else {
          $('#1').hide();
          $('.i1').prop("required",false);
        }
        if ($('#select option:selected').val() == '2') {
          $('#2').show();
          $('.i2').prop("required",true);
        } else {
          $('#2').hide();
          $('.i2').prop("required",false);
        }
        if ($('#select option:selected').val() == '3') {
          $('#3').show();
          $('.i3').prop("required",true);
        } else {
          $('#3').hide();
          $('.i3').prop("required",false);
        }
      });
    });
  </script>
@endsection