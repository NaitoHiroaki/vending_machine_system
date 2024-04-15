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
                            @foreach ($companies as $company)
                            <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                            @endforeach
                        </select>
                        <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 w-1/6 p-2.5 ml-2 hover:bg-gray-200 shadow-md" type="submit" value="検索">
                    </form>
                    <div class="relative overflow-x-auto shadow-md rounded-md mb-3">
                    <table class="w-full">
                        <thead class="text-gray-700 bg-gray-200">
                        <tr>
                            <th class="px-4 py-2 text-center">ID</th>
                            <th class="px-4 py-2 text-center">商品画像</th>
                            <th class="px-4 py-2 text-center">商品名</th>
                            <th class="px-4 py-2 text-center">価格</th>
                            <th class="px-4 py-2 text-center">在庫数</th>
                            <th class="px-4 py-2 text-center">メーカー名</th>
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
                            <td class="border-t px-4 py-2 text-center h-10">
                                @if ($product->img_path === null)
                                なし
                                @endif
                                @if ($product->img_path !== null)
                                <img class="mx-auto sm:h-12 lg:h-16" src="{{ Storage::url($product->img_path) }}" >
                                @endif
                            </td>
                            <td class="border-t px-4 py-2">{{ $product->product_name }}</td>
                            <td class="border-t px-4 py-2">¥{{ $product->price }}</td>
                            <td class="border-t px-4 py-2">{{ $product->stock }}</td>
                            <td class="border-t px-4 py-2">
                                @foreach ($companies as $company)
                                    @if($product->company_id === $company->id)
                                    {{ $company->company_name }}
                                    @endif
                                @endforeach
                            </td>
                            <td class="border-t pl-4 pr-0.5 py-2">
                                <div class="text-center">
                                <button type="submit" class="btn bg-cyan-500 hover:bg-cyan-400 shadow-md text-white">
                                    <a class="nav-link" href="{{ route('show', ['id' => $product->id] ) }}">{{ __('詳細') }}</a>
                                </button>
                                </div>
                            </td>
                            <td class="border-t pl-0.5 pr-4 py-2">
                                <form action="{{ route('destroy', ['id' => $product->id] ) }}" id="delete_{{ $product->id}}" method="post">
                                    @csrf
                                    <div class="text-center">
                                    <a href="#" class="btn bg-rose-500 hover:bg-rose-400 shadow-md text-white" data-id="{{ $product->id }}" onclick="deletePost(this);" >削除</a>
                                    </div>
                                </form>
                            </td>
                        </tr>                    
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                    {{ $products->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function deletePost(e) {
    'use strict';
    if (confirm('本当に削除していいですか?')) {
    document.getElementById('delete_' + e.dataset.id).submit();
    }
}
</script>

@endsection
