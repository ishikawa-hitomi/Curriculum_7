@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <nav class="mt-2">
          <div class="nav nav-tabs" id="nav-tab" role="tablist">
          <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Q&A</button>
            <button class="nav-link" id="nav-like-tab" data-bs-toggle="tab" data-bs-target="#nav-like" type="button" role="tab" aria-controls="nav-like" aria-selected="false">お問い合わせ</button>
          </div>
          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
              <div class="row">
                @foreach($faqs as $faq)<!-- 自分の投稿を表示 -->
                  <div class="col">
                    <div class="card m-2">
                      <div class="card-body">
                        <div>
                          <h5>Q.{{$loop->index+1}}</h5>
                          <p>{{$faq['question']}}</p>
                        </div>
                        <div>
                          <h5>A.{{$loop->index+1}}</h5>
                          <p>{{$faq['answer']}}</p>
                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
            <div class="tab-pane fade" id="nav-like" role="tabpanel" aria-labelledby="nav-like-tab">
              <div class="row">
              <div class="col">
                    <div class="card m-2">
                      <div class="card-body">
                        <form action="#" method="POST">
                          @csrf
                          <div>
                            <label for="email">メールアドレス</label>
                            <input type="email" name="email" class="form-control" required>
                          </div>
                          <input type="submit" class="btn btn-primary">
                        </form>
                      </div>
                    </div>
                    </div>
              </div>
            </div>
          </div>
        </nav>
      </div>
    </div>
  </div>
</div>
@endsection