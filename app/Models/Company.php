<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;




class Company extends Model
{
    use HasFactory;

    public function getList()
    {
        // companiesテーブルからデータを取得
        $companies = DB::table('companies')

            ->select('companies.*')

            ->get();

        return $companies;
    }

    public function definition(): array
    {
        return [
            'product_id' => \App\Models\Product::factory(), // 仮定しているProductモデルのファクトリーを利用
            // 'created_at' と 'updated_at' はEloquentが自動的に処理するので、ここに追加する必要はありません。
        ];
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
