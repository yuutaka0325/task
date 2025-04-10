<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    //use Sortable;
    use HasFactory;


    protected $fillable = [
        'product_name',
        'price',
        'stock',
        'company_id',
        'comment',
        'img_path',
    ];

    public function getList($keyword, $company, $min_price, $max_price, $min_stock, $max_stock)
    {
        // productsテーブルからデータを取得
        $query = DB::table('products')

            ->join('companies', 'products.company_id', '=', 'companies.id')
            ->select('products.*', 'companies.company_name as company_name');
        //商品名が入っていたら
        if (!empty($keyword)) {
            //productsテーブルから、product_nameにkeywordが含まれているデータを取得する
            $query->where('product_name', 'LIKE', "%{$keyword}%");

        }
        //会社IDが入っていたら
        if (!empty($company)) {
            //productsテーブルから、company_idが会社IDのデータを取得する
            $query->where('company_id', $company);
        }
        //商品名が入っていたら
        if (!empty($min_price)) {

            $query->where('price', '>=', $min_price);
        }
        //商品名が入っていたら
        if (!empty($max_price)) {

            $query->where('price', '<=', $max_price);
        }
        //商品名が入っていたら
        if (!empty($min_stock)) {

            $query->where('stock', '>=', $min_stock);
        }
        //商品名が入っていたら
        if (!empty($max_stock)) {

            $query->where('stock', '<=', $max_stock);
        }
        //mod 20250330 orderByメソッドを追加
        //orderByメソッドは指定したカラムでクエリ結果をソートします。


        $products = $query->get();

        return $products;
    }

    public function getDetail($id)
    {
        // 詳細からデータを取得
        $product = DB::table('products')
            ->join('companies', 'products.company_id', '=', 'companies.id')
            ->select('products.*', 'companies.company_name as company_name')
            ->where('products.id', $id)
            ->first();

        return $product;
    }

    public function registProduct($data, $image_path)
    {

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
            'company_id' => $request->company_name,
            'price' => $request->price,
            'stock' => $request->stock,
            'comment' => $request->comment,
            'img_path' => $request->img_path,
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

    public function getListAll()
    {
        // 詳細からデータを取得
        $products = DB::table('products')
            ->join('companies', 'products.company_id', '=', 'companies.id')
            ->select('products.*', 'companies.company_name as company_name')
            ->get();

        return $products;
    }
}
