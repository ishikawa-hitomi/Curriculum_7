@extends('layouts.app')

@section('content')
<div>
        <h1>パスワードリセットが完了しました</h1>

        <a href="{{ route('login') }}">ログイン画面へ</a>
    </div>
@endsection