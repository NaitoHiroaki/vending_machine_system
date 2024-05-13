<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRegisterRequest;
use Illuminate\Support\Facades\Storage;
// use Intervention\Image\Facades\Image;
use App\Models\Company;

class ProductRegisterController extends Controller
{

    protected $redirectTo = '/product_register';

    public function index()
    {
        $validation = new StoreProductRegisterRequest();
        $companies = Company::all();
        
        return view('product_register', compact('companies'), [
            'rules' => $validation->rules()
        ]);
    }

    public function store(StoreProductRegisterRequest $request)
    {
        try {
            // 画像フォームでリクエストした画像を取得
            $img = $request->file('img_path');

            // 画像情報がセットされていれば、保存処理を実行
            if (isset($img)) {

                // 拡張子付きでファイル名を取得
                $filename_with_ext = $img->getClientOriginalName();

                // ファイル名のみを取得
                $filename = pathinfo($filename_with_ext, PATHINFO_FILENAME);

                // 拡張子を取得
                $extension = $img->getClientOriginalExtension();

                // 保存のファイル名を構築
                $filename_to_store = $filename."_".date('Ymd_His').".".$extension;

                // 画像フォームでリクエストした画像を取得してstorage > public > img配下に画像を保存
                $path = $img->storeAs("public/img", $filename_to_store);

                // リサイズされた画像を保存
                // Image::make($img)->resize(
                //     450, // 横幅
                //     300, // 縦幅
                //     function ($constraint) {
                //         $constraint->aspectRatio();
                //         $constraint->upsize();
                //     } 
                // )->save(storage_path('app/public/img/'. $filename_to_store));

                // store処理が実行できたらDBに保存処理を実行
                if ($path) {
                    // DBに登録する処理
                    Product::create([
                        'product_name' => $request->product_name,
                        'company_id' => $request->company_id,
                        'price' => $request->price,
                        'stock' => $request->stock,
                        'comment' => $request->comment,
                        'img_path' => $path
                    ]);
                }
            }

            if (!isset($img)) {
                Product::create([
                    'product_name' => $request->product_name,
                    'company_id' => $request->company_id,
                    'price' => $request->price,
                    'stock' => $request->stock,
                    'comment' => $request->comment
                ]);
            }

            // 最新のデータを取得
            // $product = Product::orderBy('created_at', 'DESC')->orderBy('id', 'DESC')->first();
            
            // Sale::create([
            //     'product_id' => $product->id,
            // ]);

            return to_route('product_register');
        } catch (\Exception $e) {
            report($e);
            session()->flash('flash_message', '更新が失敗しました');
        }
    }

    public function show($id)
    {
        $product = Product::find($id);
        $companies = Company::all();

        return view('show', compact('product', 'companies'));
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $companies = Company::all();
        $validation = new StoreProductRegisterRequest();

        return view('edit', compact('product', 'companies'), [
            'rules' => $validation->rules()
        ]);
    }

    public function update(StoreProductRegisterRequest $request, $id)
    {
        try {
            $product = Product::find($id);

            // 既存画像を取得
            $path = $request->img_path;

            // 新規画像を取得
            $img = $request->file('img_path');
            
            // 画像を更新する場合
            if (isset($img)) {
                
                // 現在の画像ファイルの削除
                $img_name = $product->img_path;

                // /storage/app/public/img/画像ファイル名 を削除
                $img_name = str_replace('public/img/', '', $img_name);
                Storage::disk('public')->delete('img/' . $img_name);

                // 拡張子付きでファイル名を取得
                $filename_with_ext = $img->getClientOriginalName();

                // ファイル名のみを取得
                $filename = pathinfo($filename_with_ext, PATHINFO_FILENAME);

                // 拡張子を取得
                $extension = $img->getClientOriginalExtension();

                // 保存するファイル名を構築
                $filename_to_store = $filename."_".date('Ymd_His').".".$extension;

                // 画像フォームでリクエストした画像を取得してstorage > public > img配下に画像を保存
                $path = $img->storeAs("public/img", $filename_to_store);

                // リサイズされた画像を保存
                // Image::make($img)->resize(
                //     450, // 横幅
                //     300, // 縦幅
                //     function ($constraint) {
                //         $constraint->aspectRatio();
                //         $constraint->upsize();
                //     } 
                // )->save(storage_path('app/public/img/'. $filename_to_store));

                // store処理が実行できたらDBに保存処理を実行
                if ($path) {
                    // DBに登録する処理
                    $product->product_name = $request->product_name;
                    $product->company_id = $request->company_id;
                    $product->price = $request->price;
                    $product->stock = $request->stock;
                    $product->comment = $request->comment;
                    $product->img_path = $path;
                    $product->save();
                }
            }

            // 画像を更新しない場合
            if (!isset($img)) {

                $product->product_name = $request->product_name;
                $product->company_id = $request->company_id;
                $product->price = $request->price;
                $product->stock = $request->stock;
                $product->comment = $request->comment;
                $product->save();
            }

            return to_route('edit', ['id' => $product->id ] );
        } catch (\Exception $e) {
            report($e);
            session()->flash('flash_message', '更新が失敗しました');
        }
    }

    public function destroy(Request $request)
    {
        try {
            $product = Product::find($request->id);
            $product_id = $product->id;
            $sale = Sale::where('product_id', $product_id);

            $sale->delete();
            $product->delete();

            // 画像フォームでリクエストした画像を取得
            $img_name = $product->img_path;

            // 画像情報がセットされていたら保存されていた画像を削除
            if (isset($img_name)) {

                // /storage/app/public/img/画像ファイル名を削除
                $img_name = str_replace('public/img/', '', $img_name);
                Storage::disk('public')->delete('img/' . $img_name);
            }

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            report($e);
            return response()->json(['error' => '削除に失敗しました'], 500);
        }
    }
}