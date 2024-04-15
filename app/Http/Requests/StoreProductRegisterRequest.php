<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'product_name' => ['required'],
            'company_id' => ['required'],
            'price' => ['required', 'integer'],
            'stock' => ['required', 'integer']
        ];
    }

    public function messages()
    {
        return [
            'product_name.required' => '* 商品名は必須です',
            'company_id.required' => '* メーカー名は必須です',
            'price.required' => '* 価格は必須です',
            'price.integer' => '* 価格は半角で入力してください',
            'stock.required' => '* 在庫数は必須です',
            'stock.integer' => '* 在庫数は半角で入力してください',
        ];
    }
}
