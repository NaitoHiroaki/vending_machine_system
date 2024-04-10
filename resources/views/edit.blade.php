@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="h1 mb-4">商品情報編集画面</div>
                    <form id="form-area" class="shadow-md rounded-md bg-white" method="post" action="{{ route('update', ['id' => $product->id ]) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="pt-3">
                            @foreach($errors->all() as $message)
                                <p class="ml-4 text-danger">{{$message}}</p>
                            @endforeach
                        </div>
                        <div>
                            <label for="id" class="mb-2 ml-4 text-sm font-medium text-gray-900 w-1/6"><b>ID</b></label>
                            <div class="inline-block bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-3/5 p-2.5 mt-4">
                                {{ $product->id }}.
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="product_name" class="mb-2 ml-4 text-sm font-medium text-gray-900 w-1/6"><b>商品名</b>
                                @include('required',['rules' => $rules['product_name'] ?? ''])
                            </label>
                            <input id="product_name" name="product_name" type="text" value="{{ $product->product_name }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-3/5 p-2.5 mt-4"/>
                        </div>
                        <div class="mb-4">
                            <label for="maker_name" class="mb-2 ml-4 text-sm font-medium text-gray-900 w-1/6"><b>メーカー名</b>
                                @include('required',['rules' => $rules['maker_name'] ?? ''])
                            </label>
                            <select id="maker_name" name="maker_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-3/5 p-2.5">
                                <option value="">選択してください</option>
                                <option value="1" @if($product->maker_name == 1) selected @endif>Coca-Cola</option>
                                <option value="2" @if($product->maker_name == 2) selected @endif>サントリー</option>
                                <option value="3" @if($product->maker_name == 3) selected @endif>キリン</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="price" class="mb-2 ml-4 text-sm font-medium text-gray-900 w-1/6"><b>価格</b>
                                @include('required',['rules' => $rules['price'] ?? ''])
                            </label>
                            <input id="price" name="price" type="text" value="{{ $product->price }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-3/5 p-2.5"/>
                        </div>
                        <div class="mb-4">
                            <label for="stock" class="mb-2 ml-4 text-sm font-medium text-gray-900 w-1/6"><b>在庫数</b>
                                @include('required',['rules' => $rules['stock'] ?? ''])
                            </label>
                            <input id="stock" name="stock" type="text" value="{{ $product->stock }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-3/5 p-2.5"/>
                        </div>
                        <div class="mb-4">
                            <label for="comment" class="inline-block align-top mb-2 ml-4 text-sm font-medium text-gray-900 w-1/6 pt-2"><b>コメント</b>
                                @include('required',['rules' => $rules['comment'] ?? ''])
                            </label>
                            <textarea id="comment" name="comment" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-3/5 p-2.5">{{ $product->comment }}</textarea>
                        </div>
                        <div class="mb-4">
                            <label for="img_path" class="mb-2 ml-4 text-sm font-medium text-gray-900 w-1/6 pt-2"><b>商品画像</b>
                                @include('required',['rules' => $rules['img_path'] ?? ''])
                            </label>
                            <input id="img_path" name="img_path" type="file" multiple accept="image/*" class="w-3/5 text-sm file:mr-4 file:rounded-md file:border-0 file:bg-primary-500 file:py-2.5 file:px-4 file:text-sm file:font-medium file:text-black hover:file:bg-primary-700 focus:outline-none disabled:pointer-events-none disabled:opacity-60"/>
                        </div>
                        <button type="submit" class="btn bg-amber-500 hover:bg-amber-400 shadow-md text-white px-3 ml-3.5 mr-4 mt-2 mb-3">
                            更新
                        </button>
                        <button type="submit" class="btn bg-cyan-500 hover:bg-cyan-400 shadow-md text-white px-4 mt-2 mb-3">
                            <a class="nav-link" href="{{ route('show', ['id' => $product->id ] ) }}">{{ __('戻る') }}</a>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
