<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductRegister;
use App\Http\Requests\StoreProductRegisterRequest;

class ProductRegisterController extends Controller
{

    protected $redirectTo = '/product_register';

    public function index()
    {
        $validation = new StoreProductRegisterRequest();
        return view('product_register', [
            'rules' => $validation->rules(),
        ]);

        return view('product_register');
    }

    public function store(StoreProductRegisterRequest $request)
    {
        ProductRegister::create([
            'product_name' => $request->product_name,
            'maker_name' => $request->maker_name,
            'price' => $request->price,
            'stock' => $request->stock,
            'comment' => $request->comment,
            'img_path' => $request->img_path
        ]);

        return to_route('product_register');
    }

    public function show($id)
    {
        $product = ProductRegister::find($id);

        // $gender = CheckFormService::checkGender($contact);
        // $age = CheckFormService::checkAge($contact);

        return view('show', compact('product'));
    }

    public function destroy($id)
    {
        $product = ProductRegister::find($id);
        $product->delete();

        return to_route('home');
    }

}