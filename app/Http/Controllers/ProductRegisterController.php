<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductRegister;
use App\Http\Requests\StoreProductRegisterRequest;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProductRegisterController extends Controller
{

    protected $redirectTo = '/product_register';

    public function index()
    {
        $validation = new StoreProductRegisterRequest();
        
        return view('product_register', [
            'rules' => $validation->rules(),
        ]);
    }

    public function store(StoreProductRegisterRequest $request)
    {

        // 画像フォームでリクエストした画像を取得
        $img = $request->file('img_path');

        // 画像情報がセットされていれば、保存処理を実行
        if (isset($img)) {

            // 拡張子付きでファイル名を取得
            $filenameWithExt = $request->file('img_path')->getClientOriginalName();

            // ファイル名のみを取得
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            // 拡張子を取得
            $extension = $request->file('img_path')->getClientOriginalExtension();

            // 保存のファイル名を構築
            $filenameToStore = $filename."_".date('Ymd_His').".".$extension;

            // 画像フォームでリクエストした画像を取得してstorage > public > img配下に画像を保存
            $path = $request->file('img_path')->storeAs("public/img", $filenameToStore);

            // リサイズされた画像を保存
            Image::make($img)->resize(450, 300, function ($constraint) {
                $constraint->aspectRatio();
            } )->save(storage_path('app/public/img/'. $filenameToStore));

            // store処理が実行できたらDBに保存処理を実行
            if ($path) {
                // DBに登録する処理
                ProductRegister::create([
                    'product_name' => $request->product_name,
                    'maker_name' => $request->maker_name,
                    'price' => $request->price,
                    'stock' => $request->stock,
                    'comment' => $request->comment,
                    'img_path' => $path
                ]);
            }
        }

        if (!isset($img)) {
            ProductRegister::create([
                'product_name' => $request->product_name,
                'maker_name' => $request->maker_name,
                'price' => $request->price,
                'stock' => $request->stock,
                'comment' => $request->comment
            ]);
        }

        return to_route('product_register');
    }

    public function show($id)
    {
        $product = ProductRegister::find($id);

        return view('show', compact('product'));
    }

    public function edit($id)
    {
        $product = ProductRegister::find($id);
        $validation = new StoreProductRegisterRequest();

        return view('edit', compact('product'), [
            'rules' => $validation->rules()
        ]);
    }

    public function update(Request $request, $id)
    {
        
        // 画像ファイルインスタンス取得
        $img = $request->file('img_path');
        $product = ProductRegister::find($id);

        // 現在の画像へのパスをセット
        $path = $request->img_path;
        
        // 現在の画像へのパスをセット
        if (isset($img)) {
            
            // 現在の画像ファイルの削除
            $img_name = $product->img_path;
            $product->delete($path);

            // /storage/app/public/img/画像ファイル名を削除
            $img_name = str_replace('public/img/', '', $img_name);
            Storage::disk('public')->delete('img/' . $img_name);

            // 拡張子付きでファイル名を取得
            $filenameWithExt = $request->file('img_path')->getClientOriginalName();

            // ファイル名のみを取得
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            // 拡張子を取得
            $extension = $request->file('img_path')->getClientOriginalExtension();

            // 保存のファイル名を構築
            $filenameToStore = $filename."_".date('Ymd_His').".".$extension;

            // 画像フォームでリクエストした画像を取得してstorage > public > img配下に画像を保存
            $path = $request->file('img_path')->storeAs("public/img", $filenameToStore);

            // リサイズされた画像を保存
            Image::make($img)->resize(450, 300, function ($constraint) {
                $constraint->aspectRatio();
            } )->save(storage_path('app/public/img/'. $filenameToStore));

            $product->product_name = $request->product_name;
            $product->maker_name = $request->maker_name;
            $product->price = $request->price;
            $product->stock = $request->stock;
            $product->comment = $request->comment;
            $product->img_path = $path;
            $product->save();
        }

        if (!isset($img)) {

            $product->product_name = $request->product_name;
            $product->maker_name = $request->maker_name;
            $product->price = $request->price;
            $product->stock = $request->stock;
            $product->comment = $request->comment;
            $product->save();
        }

        return to_route('edit', ['id' => $product->id ] );
    }

    public function destroy($id)
    {
        $product = ProductRegister::find($id);
        $product->delete();

        // 画像フォームでリクエストした画像を取得
        $img_name = $product->img_path;

        // 画像情報がセットされていれば保存されていた画像を削除
        if (isset($img_name)) {

            // /storage/app/public/img/画像ファイル名を削除
            $img_name = str_replace('public/img/', '', $img_name);
            Storage::disk('public')->delete('img/' . $img_name);
        }

        return to_route('home');
    }

}