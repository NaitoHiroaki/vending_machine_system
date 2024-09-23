@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-md">
                <div class="card-body">
                    <div class="h1 mb-4">商品情報詳細画面</div>
                    @if (session('success_message'))
                        <div class="alert alert-success">
                            {{ session('success_message') }}
                        </div>
                    @endif

                    @if (session('error_message'))
                        <div class="alert alert-danger">
                            {{ session('error_message') }}
                        </div>
                    @endif
                    <table class="w-full sm:w-2/3 mb-4 shadow-md rounded-md bg-white">
                        <tbody>
                        <tr>
                            <td class="px-4 py-2"><b>ID</b></td>
                            <td class="px-4 py-2">{{ $product->id }}.</td>
                        </tr>
                        <tr>
                            <td class="border-t px-4 py-2"><b>商品画像</b></td>
                            <td class="border-t px-4 py-2">
                                @if ($product->img_path === null)
                                <div>なし</div>
                                @endif
                                @if ($product->img_path !== null)
                                <img class="h-32 lg:h-40" src="{{ Storage::url($product->img_path) }}">
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="border-t px-4 py-2"><b>商品名</b></td>
                            <td class="border-t px-4 py-2">{{ $product->product_name }}</td>
                        </tr>
                        <tr>
                            <td class="border-t px-4 py-2"><b>メーカー</b></td>
                            <td class="border-t px-4 py-2">
                                @foreach ($companies as $company)
                                    @if($product->company_id === $company->id)
                                    {{ $company->company_name }}
                                    @endif
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td class="border-t px-4 py-2"><b>価格</b></td>
                            <td class="border-t px-4 py-2">¥{{ $product->price }}</td>
                        </tr>
                        <tr>
                            <td class="border-t px-4 py-2"><b>在庫数</b></td>
                            <td class="border-t px-4 py-2">{{ $product->stock }}</td>
                        </tr>
                        <tr>
                            <td class="border-t px-4 py-2"><b>コメント</b></td>
                            <td class="border-t px-4 py-2">{{ $product->comment }}</td>
                        </tr>
                        </tbody>
                    </table>
                    <table id="table" Frame="Void">
                        <tr>
                        <td>
                            <div class="text-center">
                                <form method="get" action="{{ route('edit', ['id' => $product->id ]) }}">
                                <button type="submit" class="btn bg-amber-500 hover:bg-amber-400 shadow-md text-white px-4 mr-4">編集</button>
                                </form>
                            </div>
                        </td>
                        <td>
                            <div class="text-center">
                                <button type="submit" class="btn bg-cyan-500 hover:bg-cyan-400 shadow-md text-white px-4">
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
