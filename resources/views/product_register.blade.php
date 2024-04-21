@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="h1 mb-4">商品新規登録画面</div>
                    <form id="form-area" class="shadow-md rounded-md bg-white" method="post" action="{{ route('store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="pt-3">
                            @foreach($errors->all() as $message)
                                <p class="ml-4 text-danger">{{$message}}</p>
                            @endforeach
                        </div>
                        <div class="mb-4">
                            <label for="product_name" class="mb-2 ml-4 text-sm font-medium text-gray-900 w-1/6"><b>商品名</b>
                                @include('required',['rules' => $rules['product_name'] ?? ''])
                            </label>
                            <input id="product_name" name="product_name" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-3/5 p-2.5 mt-4"/>
                        </div>
                        <div class="mb-4">
                            <label for="company_id" class="mb-2 ml-4 text-sm font-medium text-gray-900 w-1/6"><b>メーカー名</b>
                                @include('required',['rules' => $rules['company_id'] ?? ''])
                            </label>
                            <select id="company_id" name="company_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-3/5 p-2.5">
                                <option value="">選択してください</option>
                                @foreach ($companies as $company)
                                <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="price" class="mb-2 ml-4 text-sm font-medium text-gray-900 w-1/6"><b>価格</b>
                                @include('required',['rules' => $rules['price'] ?? ''])
                            </label>
                            <input id="price" name="price" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-3/5 p-2.5"/>
                        </div>
                        <div class="mb-4">
                            <label for="stock" class="mb-2 ml-4 text-sm font-medium text-gray-900 w-1/6"><b>在庫数</b>
                                @include('required',['rules' => $rules['stock'] ?? ''])
                            </label>
                            <input id="stock" name="stock" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-3/5 p-2.5"/>
                        </div>
                        <div class="mb-4">
                            <label for="comment" class="inline-block align-top mb-2 ml-4 text-sm font-medium text-gray-900 w-1/6 pt-2"><b>コメント</b>
                                @include('required',['rules' => $rules['comment'] ?? ''])
                            </label>
                            <textarea id="comment" name="comment" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-3/5 p-2.5"></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="img_path" class="mb-2 ml-4 text-sm font-medium text-gray-900 w-1/6 pt-2"><b>商品画像</b>
                                @include('required',['rules' => $rules['img_path'] ?? ''])
                            </label>
                            <input id="img_path" name="img_path" type="file" onChange="imgPreView(event)" multiple accept="image/*" class="w-3/5 text-sm file:mr-4 file:rounded-md file:border-0 file:bg-primary-500 file:py-2.5 file:px-4 file:text-sm file:font-medium file:text-black hover:file:bg-primary-700 focus:outline-none disabled:pointer-events-none disabled:opacity-60"/>
                        </div>
                        <div id="preview"></div>
                        <button type="submit" class="btn bg-amber-500 hover:bg-amber-400 shadow-md text-white px-3 ml-3.5 mr-4 mt-2 mb-3">
                            新規登録
                        </button>
                        <button type="submit" class="btn bg-cyan-500 hover:bg-cyan-400 shadow-md text-white px-4 mt-2 mb-3">
                            <a class="nav-link" href="{{ route('home') }}">{{ __('戻る') }}</a>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function imgPreView(event){
    var file = event.target.files[0];
    var reader = new FileReader();
    var preview = document.getElementById("preview");
    var previewImage = document.getElementById("previewImage");
    
    if(previewImage != null)
    preview.removeChild(previewImage);

    reader.onload = function(event) {
        var img = document.createElement("img");
        img.setAttribute("src", reader.result);
        img.setAttribute("id", "previewImage");
        preview.appendChild(img);
        preview.classList.add('flex');
        preview.classList.add('justify-left');
        preview.classList.add('sm:h-32');
        preview.classList.add('lg:h-40');
        preview.classList.add('mb-2');
        preview.classList.add('ml-6');
    };

  reader.readAsDataURL(file);
}    
</script>

@endsection
