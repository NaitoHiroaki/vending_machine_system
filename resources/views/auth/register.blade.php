@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-md">
                <div class="card-body">
                <div class="h1 text-center mb-4">ユーザー新規登録画面</div>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <input id="password" type="password" class="bg-gray-200 text-gray-700 form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="パスワード">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <input id="email" type="email" class="bg-gray-200 text-gray-700 form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="アドレス">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn bg-amber-500 hover:bg-amber-400 shadow-md text-white rounded-pill px-4 mx-2">
                                    {{ __('新規登録') }}
                                </button>
                                <button type="submit" class="btn bg-cyan-500 hover:bg-cyan-400 shadow-md text-white rounded-pill mx-3">
                                <a class="nav-link px-[26.5px]" href="{{ route('login') }}">{{ __('戻る') }}</a>
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
