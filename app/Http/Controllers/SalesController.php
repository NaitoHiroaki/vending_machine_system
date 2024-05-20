<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    public function purchase(Request $request)
    {
        DB::beginTransaction();

        try {
            // リクエストから必要なデータを取得
            $productId = $request->input('product_id');
            $quantity = $request->input('quantity', 1); // quantityが送られていない場合は1を代入

            // データベースから対象の商品を検索・取得
            $product = Product::find($productId);

            // 商品が存在しない、または在庫が不足している場合のバリデーション
            if (!$product) {
                return response()->json(['message' => '商品が存在しません'], 404);
            }
            if ($product->stock < $quantity) {
                return response()->json(['message' => '商品が在庫不足です'], 400);
            }

            // 在庫を減少
            $product->stock -= $quantity;
            $product->save();

            // Salesテーブルに商品IDと購入日時を記録
            $sale = new Sale([
                'product_id' => $productId,
                // 主キーのidとcreated_at, updated_atは自動入力されるため不要
            ]);

            $sale->save();
            DB::commit();  //データベースに反映

            return response()->json(['message' => '購入成功']);

        } catch (\Exception $e) {
            report($e);
            session()->flash('flash_message', '更新が失敗しました');
            DB::rollback();
        }
    }
}
