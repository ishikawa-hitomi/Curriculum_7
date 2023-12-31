@extends('layouts.app')
@section('content')
@foreach($inquiry as $val)
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card border-light">
          <h5 class="card-title">お問い合せ編集</h5>
          <div class="card m-2">
            <div class="card-body">
              <form action="{{route('inquiry.update',['inquiry'=>$val['id']])}}" method="POST">
                @csrf
                @method('PUT')
                <div>
                  <label>質問</label>
                  <textarea class="form-control" disabled>{{$val['question']}}</textarea>
                </div>
                <div>
                  <label for="answer">回答</label>
                  <textarea name="answer" class="form-control" required>{{$val['answer']}}</textarea>
                </div>
                <input type="submit" class="btn btn-primary">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endforeach
@endsection