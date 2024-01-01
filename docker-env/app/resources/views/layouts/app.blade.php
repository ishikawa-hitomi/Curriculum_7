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

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!--jQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        @if(Auth::check())
            <nav class="nav">
                <div class="container">
                    <ul class="nav justify-content-between">
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('inquiry.index')}}">Q&A</a>
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
        @else
            <nav class="nav">
                <div class="container">
                    <ul class="nav justify-content-between">
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('inquiry.index')}}">F&Q</a>
                        </li>
                        <li class="nav-item d-flex">
                        <a class="nav-link" href="{{ route('login') }}">ログイン</a><a class="nav-link disabled">/</a><a class="nav-link" href="{{ route('register') }}">新規登録</a>
                        </li>
                    </ul>
                </div>
            </nav>
        @endif
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
