<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;

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
        ->get();

        return view('home', compact('companies', 'select', 'products'));
    }

    public function extractProduct($searchName = null, $selectCompany = null, $maxPrice = null, $minPrice = null, $maxStock = null, $minStock = null)
    {
        $companies = Company::all();

        $query = Product::query();
        $search_split = mb_convert_kana($searchName, 's');
        $search_split2 = preg_split('/[\s]+/', $search_split);
        if($searchName === '%'){
            foreach( $search_split2 as $value ){
                $query->where('product_name', 'like', '%' .$value. '%');
            }
        }
        if($searchName !== '%'){
            foreach( $search_split2 as $value ){
                $value_esc = '%' . addcslashes($value, '%_\\') . '%';
                $query->where('product_name', 'like', '%' .$value_esc. '%');
            }
        }

        if($selectCompany !== null && $selectCompany !== '%') {
            $query->where('company_id', '=', $selectCompany);
        }

        if($maxPrice !== '%' && $minPrice !== '%') {
            $max_price_value = $query->max('price');
            $min_price_value = $query->min('price');
            $query->where(function($query) use ($max_price_value, $min_price_value) {
                $query->where('price', '=', $max_price_value)
                ->orWhere('price', '=', $min_price_value);
            });
        }

        if($maxPrice !== '%' && $minPrice === '%') {
            $max_price_value = $query->max('price');
            $query->where('price', '=', $max_price_value);
        }

        if($maxPrice === '%' && $minPrice !== '%') {
            $min_price_value = $query->min('price');
            $query->where('price', '=', $min_price_value);
        }

        if($maxStock !== '%' && $minStock !== '%') {
            $max_stock_value = $query->max('stock');
            $min_stock_value = $query->min('stock');
            $query->where(function($query) use ($max_stock_value, $min_stock_value) {
                $query->where('stock', '=', $max_stock_value)
                ->orWhere('stock', '=', $min_stock_value);
            });
        }

        if($maxStock !== '%' && $minStock === '%') {
            $max_stock_value = $query->max('stock');
            $query->where('stock', '=', $max_stock_value);
        }

        if($maxStock === '%' && $minStock !== '%') {
            $min_stock_value = $query->min('stock');
            $query->where('stock', '=', $min_stock_value);
        }

        $products = $query->select('id', 'img_path', 'product_name', 'price', 'stock', 'company_id')
        ->get();

        return response()->json([$products, $companies]);
    }

}
