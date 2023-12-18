@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">パスワード再設定メール送信フォーム</div>
        <div class="card-body">
          <form method="post" action="{{ route('password_reset.email.send') }}">
            @csrf
            <div class="row mb-3">
              <label for="email" class="col-md-4 col-form-label text-md-end">メールアドレス</label>
              <div class="col-md-6">
                <input type="text" name="email" id="email" value="{{ old('email') }}" class="form-control">
                @error('email')
                  <span class="error">{{ $message }}</span>
                @enderror
              </div>
            </div>
            <div class="row mb-0">
              <div class="col-md-8 offset-md-4">
                <input type="submit" class="btn btn-primary" value="再設定用メールを送信">
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection