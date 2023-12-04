@extends('layouts.layout')
@section('content')
  @foreach($users as $user)
    <table>
      <tr>
        <th>{{$user['name']}}</th>
        <th>{{$user['email']}}</th>
      </tr>
    </table>
    <form action="{{route('user_delete',['user'=>Auth::user()->id])}}" method="post">
    @csrf
        <input type='hidden' name='del_flg' value="0">
      <input type='submit' value="削除">
    </form>
  @endforeach
@endsection