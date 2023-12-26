<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!--スライダー見た目-->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css">

    <!--jQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <!--スライダー動かすやつ-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>カリキュラム7</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    @yield('stylesheet')
</head>
<body>
  <header>
    @if(Auth::check())
    <nav class="nav">
        <div class="container">
          <ul class="nav justify-content-between">
            <li class="nav-item">
              <a class="nav-link" href="{{route('faq_view')}}">F&Q</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('recipe.index')}}">main</a>
            </li>
            <li class="nav-item d-flex">
              <a class="nav-link disabled">{{Auth::user()->name}}</a><a class="nav-link disabled">/</a><a class="nav-link" href="#" id="logout">ログアウト</a>
            </li>
          </ul>
        </div>
      </nav>
      <form action="{{route('logout')}}" method="post" style="display:none;" id="logout-form">
          @csrf
      </form>
      <script>
          document.getElementById('logout').addEventListener('click',function(event){
              event.preventDefault();
              document.getElementById('logout-form').submit();
          });
      </script>
    @endif
  </header>
  <div class="main container-fluid">
    <div class="row">
      <div class="left-content col-lg-4 my-2"><!-- カラム（左） -->
        @can('general')
          <div class="navbar-expand-lg bg-body-tertiary">
            <div class="d-flex justify-content-between">
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"><image class="img-fluid" src="{{asset('メニューの無料アイコン5.png')}}"></span>
              </button>
              <div>
                <a href="{{route('recipe.create')}}" type='button' class="btn btn-primary m-1">新規投稿</a>
                <a href="{{route('user.show',['user'=>Auth::user()->id])}}"type='button' class="btn btn-primary m-1">マイページ</a>
              </div>
            </div>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <div class="container-fluid">
                <form action="{{route('recipe.index')}}" method="GET">
                  <div>
                    <label class="keyword" class="form-label">キーワード</label>
                    <input type="text" name="keyword" class="form-control" value="{{e(request()->input('keyword'))}}">
                    <small>スペースで複数の条件検索可能</small>
                  </div>
                  <div>
                    <label class="date" class="form-label">投稿日</label>
                    <div class="input-group">
                      <input type="date" name="from" class="form-control" value="{{e(request()->input('from'))}}">
                      〜
                      <input type="date" name="to" class="form-control" value="{{e(request()->input('to'))}}">
                    </div>
                  </div>
                  <input type="submit" value="検索" class="btn btn-primary">
                </form>
              </div>
            </div>
        </div>
        @endcan
        @can('admin')
          <h5>管理者用画面</h5>
          <a href="{{route('admin.user_index')}}">
            <button>ユーザー検索</button>
          </a>
          <a href="{{route('admin.recipe_index')}}">
            <button>投稿検索</button>
          </a>
        @endcan
      </div>

      <div class="main-content col-lg-6"><!-- カラム（メイン） -->
          @yield('content')
      </div>

      <div class="right-content col-lg-2 bg-info"><!-- カラム（右） -->
      </div>
    </div>
  </div>
</body>
</html>