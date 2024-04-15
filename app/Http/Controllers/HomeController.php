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

        $search = $request->search;
        $query = Product::search($search);

        $companies = Company::all();

        $select = $request->input('select'); 
        if($select !== null) {
            $query->where('company_id', '=', $select);
        }

        $products = $query->select('id', 'img_path', 'product_name', 'price', 'stock', 'company_id')
        ->paginate(10);

        return view('home', compact('companies', 'select', 'products'));
    }
}
