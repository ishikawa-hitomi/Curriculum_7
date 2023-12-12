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
      <input type="submit" value="削除する">
    </form>
  @endforeach
@endsection