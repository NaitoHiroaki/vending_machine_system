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
    public function index()
    {
        $products = ProductRegister::select('id', 'img_path', 'product_name', 'price', 'stock', 'maker_name')
        ->get();

        return view('home', compact('products'));
    }
}
