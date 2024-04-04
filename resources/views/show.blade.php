@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                    <div class="h1 mb-4">商品情報詳細画面</div>
                    <div class="form-group">
                        <div class="input-group">
                            <label for="id">ID</label>
                            <div>{{ $product->id }}.</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <label for="img_path">商品画像</label>
                            @if ($product->img_path === null)
                            <div>なし</div>
                            @endif
                            @if ($product->img_path !== null)
                            <img src="{{ Storage::url($product->img_path) }}" width="25%" height="25%">
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <label for="product_name">商品名</label>
                            <div>{{ $product->product_name }}</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <label for="maker_name">メーカー</label>
                            <div>
                                @if($product->maker_name === "1")
                                Coca-Cola
                                @endif
                                @if($product->maker_name === "2")
                                サントリー
                                @endif
                                @if($product->maker_name === "3")
                                キリン
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <label for="price">価格</label>
                            <div>¥{{ $product->price }}</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <label for="stock">在庫数</label>
                            <div>{{ $product->stock }}</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <label for="comment">コメント</label>
                            <div>{{ $product->comment }}</div>
                        </div>
                    </div>
                    <table id="table" Frame="Void">
                        <tr>
                            <td>
                                <div class="text-center">
                                    <form method="get" action="{{ route('edit', ['id' => $product->id ]) }}">
                                    <button type="submit" class="btn btn-warning">編集</button>
                                    </form>
                                </div>
                            </td>
                            <td>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-info">
                                    <a class="nav-link" href="{{ route('home') }}">{{ __('戻る') }}</a>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
