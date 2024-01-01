@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card border-light">
        {{Breadcrumbs::render('inquiry.index')}}
          <ul class="nav">
            <li class="nav-item"><a class="nav-link disabled">Q&A</a></li>
            <li class="nav-item"><a class="nav-link" href="{{route('inquiry.create')}}">お問い合わせ</a></li>
          </ul>
          <div class="row">
            @foreach($inquiry as $val)
              @can('general')
                @if($val['answer']!=NULL)
                  <div class="card m-2">
                    <div class="card-body">
                      <div>
                        <h5>Q.{{$loop->index+1}}</h5>
                        <p>{{$val['question']}}</p>
                      </div>
                      <div>
                        <h5>A.{{$loop->index+1}}</h5>
                        <p>{{$val['answer']}}</p>
                      </div>
                    </div>
                  </div>
                @endif
              @elsecan('admin')
                <div class="card m-2">
                  <div class="card-body">
                    <div>
                      <h5>Q.{{$loop->index+1}}</h5>
                      <p>{{$val['question']}}</p>
                    </div>
                    <div>
                      <h5>A.{{$loop->index+1}}</h5>
                      <p>{{$val['answer']}}</p>
                      <a href="{{route('inquiry.edit',['inquiry'=>$val['id']])}}">編集</a>
                    </div>
                  </div>
                </div>
              @endcan
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection