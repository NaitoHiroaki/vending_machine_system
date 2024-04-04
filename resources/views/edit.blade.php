@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                    <div class="h1 mb-4">商品情報編集画面</div>
                    <form id="form-area" class="form-inline" method="post" action="{{ route('update', ['id' => $product->id ]) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="input-group">
                                <label for="id">ID</label>
                                <div>{{ $product->id }}.</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <label for="product_name">商品名
                                    @include('required',['rules' => $rules['product_name'] ?? ''])
                                </label>
                                <input id="product_name" name="product_name" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <label for="maker_name">メーカー名
                                    @include('required',['rules' => $rules['maker_name'] ?? ''])
                                </label>
                                <select id="maker_name" name="maker_name" class="form-control">
                                    <option value="">選択してください</option>
                                    <option value="1">Coca-Cola</option>
                                    <option value="2">サントリー</option>
                                    <option value="3">キリン</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <label for="price">価格
                                    @include('required',['rules' => $rules['price'] ?? ''])
                                </label>
                                <input id="price" name="price" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <label for="stock">在庫数
                                    @include('required',['rules' => $rules['stock'] ?? ''])
                                </label>
                                <input id="stock" name="stock" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <label for="comment">コメント
                                    @include('required',['rules' => $rules['comment'] ?? ''])
                                </label>
                                <textarea id="comment" name="comment"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <label for="img_path">商品画像
                                    @include('required',['rules' => $rules['img_path'] ?? ''])
                                </label>
                                <input id="img_path" name="img_path" type="file" multiple accept="image/*" >
                            </div>
                        </div>
                        <button type="submit" class="btn btn-warning">
                            更新
                        </button>
                        <button type="submit" class="btn btn-info">
                            <a class="nav-link" href="{{ route('show', ['id' => $product->id ] ) }}">{{ __('戻る') }}</a>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
