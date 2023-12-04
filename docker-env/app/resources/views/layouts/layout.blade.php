<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>カリキュラム7</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    @yield('stylesheet')
</head>
<body>
  <header>
    @if(Auth::check())
      <span class="my-navbar-item">{{Auth::user()->name}}</span>
      /
      <a href="#" id="logout" class="my-navbar-item">ログアウト</a>
      <a href="{{route('index')}}">main</a>
      <form action="{{route('logout')}}" method="post" style="display:none;" id="logout-form">
          @csrf
      </form>
      <script>
          document.getElementById('logout').addEventListener('click',function(event){
              event.preventDefault();
              document.getElementById('logout-form').submit();
          });
      </script>
    @else
          <a href="{{route('login')}}" class="my-navbar-item">ログイン</a>
          /
          <a href="{{route('register')}}" class="my-navbar-item">会員登録</a>
    @endif
  </header>
  <div class="main container-fluid">
    <div class="row">
    <div class="left-content col-md-4 bg-success">
        <div>
          <a href="{{route('recipe_create')}}">
            <button type='button'>新規投稿</button>
          </a>
          <a href="{{route('my_page',['user'=>Auth::user()->id])}}">
            <button type='button'>マイページ</button>
          </a>
        </div>
        左
      </div>

      <div class="main-content col-md-7">
        @yield('content')
      </div>

      <div class="right-content col-md-1 bg-info">
        右
      </div>
    </div>
  </div>
</body>
</html>