<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    public function getList() {
        // productsテーブルからデータを取得
        $products = DB::table('products')
        ->join('companies', 'products.company_id', '=', 'companies.id')
    ->select('products.*', 'companies.company_name as company_name')
   
    ->get();

        return $products;
    }

    public function getDetail($id) {
        // 詳細からデータを取得
        $product = DB::table('products')
        ->join('companies', 'products.company_id', '=', 'companies.id')
    ->select('products.*', 'companies.company_name as company_name')
    ->where('products.id',$id)
    ->first();
    

        return $product;
    }

    public function registProduct($data,$image_path) {

        // 登録処理
        DB::table('products')->insert([
            'product_name' => $data->product_name,
            'company_id' => $data->company_name,
            'price' => $data->price,
            'stock' => $data->stock,
            'comment' => $data->comment,
            'img_path' => $image_path,
        ]);
    }
    // 以下の情報（属性）を一度に保存したり変更したりできるように設定しています。
    // $fillable を設定しないと、Laravelはセキュリティリスクを避けるために、この一括代入をブロックします。
    protected $fillable = [
        'product_name',
        'price',
        'stock',
        'company_id',
        'comment',
        'img_path',
    ];
    //更新処理
     
    public function updateProduct($request, $product)
    {
        $result = $product->fill([
            'product_name' => $request->product_name
        ])->save();

        return $result;
    }

    // Productモデルがsalesテーブルとリレーション関係を結ぶためのメソッドです
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    // Productモデルがcompanysテーブルとリレーション関係を結ぶ為のメソッドです
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
