@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-md">
                <div class="card-body">
                    <div class="h1 text-center mb-4">ユーザーログイン画面</div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <input id="password" type="password" class="bg-gray-200 text-gray-700 form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="パスワード">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <input id="email" type="email" class="bg-gray-200 text-gray-700 form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="アドレス">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn bg-amber-500 hover:bg-amber-400 shadow-md text-white rounded-pill px-4 mx-2">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('新規登録') }}</a>
                                </button>
                                <button type="submit" class="btn bg-cyan-500 hover:bg-cyan-400 shadow-md text-white rounded-pill px-4 mx-3">
                                    {{ __('ログイン') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
