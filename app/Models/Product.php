<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'price',
        'stock',
        'company_id',
        'comment',
        'img_path',
    ];

    public function getList($keyword,$company) {
        // productsテーブルからデータを取得
        
        $query = DB::table('products')
        ->join('companies', 'products.company_id', '=', 'companies.id')
    ->select('products.*', 'companies.company_name as company_name');
    //商品名が入っていたら
    if(!empty($keyword)){
        //productsテーブルから、product_nameにkeywordが含まれているデータを取得する
        $query->where('product_name', 'LIKE', "%{$keyword}%");
    }
    //会社IDが入っていたら
    if(!empty($company)){
        //productsテーブルから、company_idが会社IDのデータを取得する
        $query->where('company_id', $company);

    }
    $products = $query->get();
    
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
    
    //更新処理
     public function updateProduct($request, $product)
    {
        $result = $product->fill([
            'product_name' => $request->product_name,
            'company_id' => $data->company_name,
            'price' => $data->price,
            'stock' => $data->stock,
            'comment' => $data->comment,
            'img_path' => $image_path->img_path,
        ])->save();

        return $result;
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
