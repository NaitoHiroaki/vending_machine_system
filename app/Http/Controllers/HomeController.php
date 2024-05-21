<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $companies = Company::all();

        $search = $request->search;
        $query = Product::search($search);

        $select = $request->input('select'); 
        if($select !== null) {
            $query->where('company_id', '=', $select);
        }

        $products = $query->select('id', 'img_path', 'product_name', 'price', 'stock', 'company_id')
        ->paginate(10);

        return view('home', compact('companies', 'select', 'products'));
    }

    public function filter(Request $request)
    {
        try {
            $companies = Company::all();
            $query = Product::query();

            $search_name = $request->input('search_name');
            $company_id = $request->input('select_company');
            $max_price = $request->input('max_price');
            $min_price = $request->input('min_price');
            $max_stock = $request->input('max_stock');
            $min_stock = $request->input('min_stock');

            $search_split = mb_convert_kana($search_name, 's');
            $search_split2 = preg_split('/[\s]+/', $search_split);
            if($search_name) {
                foreach( $search_split2 as $value ) {
                    $value_esc = '%' . addcslashes($value, '%_\\') . '%';
                    $query->where('product_name', 'like', '%' .$value_esc. '%');
                }
            }

            if($company_id) {
                $query->where('company_id', '=', $company_id);
            }

            if($max_price) {
                $query->where('price', '<=', $max_price);
            }

            if($min_price) {
                $query->where('price', '>=', $min_price);
            }

            if($max_stock) {
                $query->where('stock', '<=', $max_stock);
            }

            if($min_stock) {
                $query->where('stock', '>=', $min_stock);
            }

            $products = $query->select('id', 'img_path', 'product_name', 'price', 'stock', 'company_id')
            ->paginate(10);

            return view('home', compact('companies', 'products'));

        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
