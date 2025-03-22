<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        logger()->info('Request Data:', $this->all());
        return [
            'product_name' => 'required | string',
            'company_name' => 'required',
            'price' => 'required | numeric',
            'stock' => 'required | integer',
            
            
            
        ];
    }

    public function attributes()
    {
        return [
            'product_name' => '商品名',
            'company_name' => 'メーカー',
            'price' => '価格',
            'stock' => '在庫数',
            'comment' => 'コメント',
            
        ];
    }
    public function messages() {
        return [
            'product_name.required' => ':attributeは必須項目です。',
            'company_name.required' => ':attributeは必須項目です。',
            'price.required' => ':attributeは必須項目です。',
            'stock.required' => ':attributeは必須項目です。',
            
        ];
    }
    
}
