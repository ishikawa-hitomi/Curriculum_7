@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">新しいパスワードを設定</div>
        <div class="card-body">
          <form method="POST" action="{{ route('password_reset.update') }}">
            @csrf
            <input type="hidden" name="reset_token" value="{{ $userToken->token }}">
            <div class="row mb-3">
              <label for="password" class="col-md-4 col-form-label text-md-end">パスワード</label>
              <div class="col-md-6">
                <input type="password" name="password" class="input {{ $errors->has('password') ? 'incorrect' : '' }}" class="form-control">
                @error('password')
                  <div class="error">{{ $message }}</div>
                @enderror
                @error('token')
                  <div class="error">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="row mb-3">
              <label for="password_confirmation" class="col-md-4 col-form-label text-md-end">パスワードを再入力</label>
              <div class="col-md-6">
                <input type="password" name="password_confirmation" class="input {{ $errors->has('password_confirmation') ? 'incorrect' : '' }}" class="form-control">
              </div>
            </div>
            <div class="row mb-0">
              <div class="col-md-8 offset-md-4">
                <input type="submit" class="btn btn-primary" value="パスワードを再設定">
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection