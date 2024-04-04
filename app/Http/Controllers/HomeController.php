<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductRegister;

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

        $search = $request->search;
        $query = ProductRegister::search($search);

        $maker_names = [
            "1",  // Coca-Cola
            "2",  // サントリー
            "3"   // キリン
        ];
        $select = $request->input('select'); 
        if($select !== null) {
            $query->where('maker_name', '=', $select);
        }

        $products = $query->select('id', 'img_path', 'product_name', 'price', 'stock', 'maker_name')
        ->get();

        return view('home', compact('products', 'maker_names', 'select'));
    }
}
