@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-md">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="h1 mb-4">商品一覧画面</div>
                    <form class="mb-4" method="get" action="{{ route('home') }}">
                        <input class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 w-2/6 p-2.5 mr-2" type="text" name="search" placeholder="検索キーワード">
                        <select class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 w-2/6 p-2.5 mx-2" name="select">
                            <option value="">メーカー名</option>
                            @foreach($maker_names as $maker_name)
                                <option value="{{ $maker_name }}" @if($select == $maker_name) selected @endif>
                                    @if($maker_name === "1")
                                    Coca-Cola
                                    @endif
                                    @if($maker_name === "2")
                                    サントリー
                                    @endif
                                    @if($maker_name === "3")
                                    キリン
                                    @endif
                                </option>
                            @endforeach
                        </select>
                        <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 w-1/6 p-2.5 ml-2 hover:bg-gray-200 shadow-md" type="submit" value="検索">
                    </form>
                    <div class="relative overflow-x-auto shadow-md rounded-md mb-2">
                    <table class="w-full">
                        <thead class="text-gray-700 bg-gray-200">
                        <tr>
                            <th class="px-4 py-2">ID</th>
                            <th class="px-4 py-2">商品画像</th>
                            <th class="px-4 py-2">商品名</th>
                            <th class="px-4 py-2">価格</th>
                            <th class="px-4 py-2">在庫数</th>
                            <th class="px-4 py-2">メーカー名</th>
                            <th class="px-4 py-2" colspan="2">
                                <div class="text-center">
                                <button type="submit" class="btn bg-amber-500 hover:bg-amber-400 shadow-md text-white">
                                    <a class="nav-link" href="{{ route('product_register') }}">{{ __('新規登録') }}</a>
                                </button>
                                </div>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                        <tr class="odd:bg-white even:bg-gray-50">
                            <td class="border-t px-4 py-2">{{ $product->id }}.</td>
                            <td class="border-t px-4 py-2">
                                @if ($product->img_path === null)
                                なし
                                @endif
                                @if ($product->img_path !== null)
                                あり
                                @endif
                            </td>
                            <td class="border-t px-4 py-2">{{ $product->product_name }}</td>
                            <td class="border-t px-4 py-2">¥{{ $product->price }}</td>
                            <td class="border-t px-4 py-2">{{ $product->stock }}</td>
                            <td class="border-t px-4 py-2">
                                @if($product->maker_name === "1")
                                Coca-Cola
                                @endif
                                @if($product->maker_name === "2")
                                サントリー
                                @endif
                                @if($product->maker_name === "3")
                                キリン
                                @endif
                            </td>
                            <td class="border-t pl-4 pr-1 py-2">
                                <div class="text-center">
                                <button type="submit" class="btn bg-cyan-500 hover:bg-cyan-400 shadow-md text-white">
                                    <a class="nav-link" href="{{ route('show', ['id' => $product->id] ) }}">{{ __('詳細') }}</a>
                                </button>
                                </div>
                            </td>
                            <td class="border-t pl-1 pr-4 py-2">
                                <form action="{{ route('destroy', ['id' => $product->id] ) }}" method="post">
                                    @csrf
                                    <div class="text-center">
                                    <button type="submit" class="btn bg-rose-500 hover:bg-rose-400 shadow-md text-white">削除</button>
                                    </div>
                                </form>
                            </td>
                        </tr>                    
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
