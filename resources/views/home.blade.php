@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <!-- <div class="card-header">{{ __('Dashboard') }}</div> -->

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="h1 mb-4">商品一覧画面</div>
                    <!-- {{ __('You are logged in!') }} -->
                    <table id="table" border="1">
                        <tr>
                            <td>ID</td>
                            <td>商品画像</td>
                            <td>商品名</td>
                            <td>価格</td>
                            <td>在庫数</td>
                            <td>メーカー名</td>
                            <td>
                                <!-- <input id="tuikaBtn" type="button" name="touroku" value="新規登録"> -->
                                <button type="submit" class="btn btn-warning">
                                    <a class="nav-link" href="{{ route('product_register') }}">{{ __('新規登録') }}</a>
                                </button>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
