@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                    <div class="h1 mb-4">商品新規登録画面</div>
                    <button type="submit" class="btn btn-info">
                        <a class="nav-link" href="{{ route('home') }}">{{ __('戻る') }}</a>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
