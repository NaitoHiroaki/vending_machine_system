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
                    <form class="mb-4 flex items-center" method="get" action="{{ route('home') }}">
                        <input class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 w-3/10 p-2.5 mr-2" type="text" name="search" id="search_name" value="" placeholder="検索キーワード">
                        <select class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 w-1/6 p-2.5 mx-2" name="select" id="select_company">
                            <option value="">メーカー名</option>
                            @foreach ($companies as $company)
                                <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                            @endforeach
                        </select>
                        <div class="flex flex-col mx-2">
                            <div class="flex">
                                <input type="checkbox" name="max_price_checkbox" id="max_price_checkbox" class="mr-1.5">
                                <label for="max_price_checkbox">最大価格</label>
                            </div>
                            <div class="flex">
                                <input type="checkbox" name="min_price_checkbox" id="min_price_checkbox" class="mr-1.5">
                                <label for="min_price_checkbox">最小価格</label>
                            </div>
                        </div>
                        <div class="flex flex-col mx-2">
                            <div class="flex">
                                <input type="checkbox" name="max_stock_checkbox" id="max_stock_checkbox" class="mr-1.5">
                                <label for="max_stock_checkbox">最大在庫数</label>
                            </div>
                            <div class="flex">
                                <input type="checkbox" name="min_stock_checkbox" id="min_stock_checkbox" class="mr-1.5">
                                <label for="min_stock_checkbox">最小在庫数</label>
                            </div>
                        </div>
                        <button class="search-icon bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 w-1/6 p-2.5 ml-2 hover:bg-gray-200 shadow-md" type="button">検索</button>
                        <button type="submit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 w-1/7 p-2.5 ml-4 hover:bg-gray-200 shadow-md">
                            <a class="nav-link" href="{{ route('home' ) }}">{{ __('クリア') }}</a>
                        </button>
                    </form>
                    <div class="relative overflow-x-auto shadow-md rounded-md mb-3">
                    <table id="fav-table" class="product-table w-full">
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
                                <form>
                                    <input data-user_id="{{ $product->id }}" type="submit" class="btn bg-rose-500 hover:bg-rose-400 shadow-md text-white btn-dell" value="削除">
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

<style>
.tablesorter-headerUnSorted {
    background-image: url(data:image/gif;base64,R0lGODlhFQAJAIAAACMtMP///yH5BAEAAAEALAAAAAAVAAkAAAIXjI+AywnaYnhUMoqt3gZXPmVg94yJVQAAOw==);
    background-repeat: no-repeat;
    background-position: center right;
}
.tablesorter-headerAsc {
    background-image: url(data:image/gif;base64,R0lGODlhFQAEAIAAACMtMP///yH5BAEAAAEALAAAAAAVAAQAAAINjI8Bya2wnINUMopZAQA7);
    background-repeat: no-repeat;
    background-position: center right;
    border-bottom: #4a5568 2px solid;
}
.tablesorter-headerDesc {
    background-image: url(data:image/gif;base64,R0lGODlhFQAEAIAAACMtMP///yH5BAEAAAEALAAAAAAVAAQAAAINjB+gC+jP2ptn0WskLQA7);
    background-repeat: no-repeat;
    background-position: center right;
    border-bottom: #4a5568 2px solid;
}
.sorter-false {
    background-image: none;
}
</style>

<script>
function deletePost(e) {
    'use strict';
    if (confirm('本当に削除していいですか?')) {
        document.getElementById('delete_' + e.dataset.id).submit();
    }
}
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
    }
});
$(document).ready(function() {
    $('.search-icon').on('click', function() {
        $('.product-table tbody').empty();

        let searchName = $('#search_name').val();
        if (searchName === '%') {
            searchName += '%';
        }
        if (!searchName) {
            searchName = '%';
        }

        let selectCompany = $('#select_company').val();
        if (!selectCompany) {
            selectCompany = '%';
        }

        let maxPrice = '%';
        if ($('#max_price_checkbox').is(':checked')) {
            maxPrice = 'あり';
        }

        let minPrice = '%';
        if ($('#min_price_checkbox').is(':checked')) {
            minPrice = 'あり';
        }

        let maxStock = '%';
        if ($('#max_stock_checkbox').is(':checked')) {
            maxStock = 'あり';
        }

        let minStock = '%';
        if ($('#min_stock_checkbox').is(':checked')) {
            minStock = 'あり';
        }

        let requestData = {
            'search_name': searchName,
            'select_company': selectCompany,
            'max_price': maxPrice,
            'min_price': minPrice,
            'max_stock': maxStock,
            'min_stock': minStock,
        };

        if (searchName === '%' 
        && selectCompany === '%' 
        && maxPrice === '%' 
        && minPrice === '%' 
        && maxStock === '%' 
        && minStock === '%') {
            requestData = {};
        }

        let url  
        = '/home/searchName=' + searchName 
        + '/selectCompany=' + selectCompany 
        + '/maxPrice=' + maxPrice 
        + '/minPrice=' + minPrice 
        + '/maxStock=' + maxStock 
        + '/minStock=' + minStock;

        sendAjaxRequest(url, requestData);
    });

    $('#fav-table').tablesorter({
        headers: {
            6: { sorter: false }
        }
    });

    // 初回の削除ボタンのバインド
    bindDeleteButton();
});

function sendAjaxRequest(url, requestData) {
    $.ajax({
        type: 'GET',
        url: url,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: requestData,
        dataType: 'json',
    }).done(function (data) {
        $('.loading').addClass('display-none');
        let html = '';

        $.each(data[0], function (index, product) {
            let product_id = product.id;
            let img_path = product.img_path;
            let product_name = product.product_name;
            let price = product.price;
            let stock = product.stock;
            let company_id_in_products = product.company_id;
            let img_html = img_path ? `<img class="mx-auto sm:h-12 lg:h-16" src="/storage/img/${img_path.substr(11)}">` : 'なし';
            let destroy_url = "{{ route('destroy', '*') }}".replace('*', product_id);
            let company_name = '';

            $.each(data[1], function (index, company) {
                let company_id_in_companies = company.id;
                if (company_id_in_products === company_id_in_companies) {
                    company_name = company.company_name;
                    return false;
                }
            });

            html += `
                <tr class="odd:bg-white even:bg-gray-50">
                    <td class="border-t px-4 py-2">${product_id}.</td>
                    <td class="border-t px-4 py-2 text-center h-10">${img_html}</td>
                    <td class="border-t px-4 py-2">${product_name}</td>
                    <td class="border-t px-4 py-2">¥${price}</td>
                    <td class="border-t px-4 py-2">${stock}</td>
                    <td class="border-t px-4 py-2">${company_name}</td>
                    <td class="border-t pl-4 pr-0.5 py-2">
                        <div class="text-center">
                            <button type="submit" class="btn bg-cyan-500 hover:bg-cyan-400 shadow-md text-white">
                                <a class="nav-link" href="/${product_id}">詳細</a>
                            </button>
                        </div>
                    </td>
                    <td class="border-t pl-0.5 pr-4 py-2">
                        <form>
                            <input data-user_id="${product_id}" type="submit" class="btn bg-rose-500 hover:bg-rose-400 shadow-md text-white btn-dell" value="削除">
                        </form>
                    </td>
                </tr>`;
        });
        $('.product-table tbody').append(html);

        // テーブルが更新された後にテーブルソーターを再初期化
        $('#fav-table').trigger('update');
        $('#fav-table').trigger('appendCache');

        // テーブルが更新された後に削除ボタンのクリックイベントを再度バインド
        bindDeleteButton();
    }).fail(function () { 
        alert("通信に失敗しました");
    });
}

// 削除ボタンのクリックイベントを再度バインドする関数
function bindDeleteButton() {
    $('.btn-dell').off('click').on('click', function(e) {
        e.preventDefault(); // ボタンのデフォルトの動作を無効化
        var deleteConfirm = confirm('本当に削除していいですか?');
        if(deleteConfirm == true) {
            var clickEle = $(this);
            var userID = clickEle.attr('data-user_id');
            $.ajax({
                type: 'POST', // ルーティングをPOSTに変更
                url: '/'+userID+'/destroy',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'id': userID,
                    "_method": "DELETE"
                },
                dataType: 'json',
            })
            .done(function() {
                // 通信が成功した場合、クリックした要素の親要素の <tr> を削除
                clickEle.closest('tr').remove();
            })
            .fail(function() {
                alert('削除に失敗しました');
            });
        }
    });
}
</script>

@endsection
