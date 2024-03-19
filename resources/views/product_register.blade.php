@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                    <div class="h1 mb-4">商品新規登録画面</div>
                    <form id="form-area" class="form-inline" method="post">
                        <div class="form-group">
                            <div class="input-group">
                                <label for="product-name">商品名</label>
                                <input id="product-name" name="namae" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <label for="maker-name">メーカー名</label>
                                <!-- <input id="maker-name" name="namae" type="text" class="form-control"> -->
                                <select id="maker-name" name="namae" class="form-control">
                                    <option value="">選択してください</option>
                                    <option value="1">Coca-Cola</option>
                                    <option value="2">サントリー</option>
                                    <option value="3">キリン</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <label for="price">価格</label>
                                <input id="price" name="namae" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <label for="stock">在庫数</label>
                                <input id="stock" name="namae" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <label for="comment">コメント</label>
                                <textarea id="comment" name="namae"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <label for="img_path">商品画像</label>
                                <input id="img_path" name="namae" type="file" multiple accept="image/*" >
                            </div>
                        </div>
                    </form>
                    <button type="submit" class="btn btn-warning">
                        <a class="nav-link" href="{{ route('home') }}">{{ __('新規登録') }}</a>
                    </button>
                    <button type="submit" class="btn btn-info">
                        <a class="nav-link" href="{{ route('home') }}">{{ __('戻る') }}</a>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
