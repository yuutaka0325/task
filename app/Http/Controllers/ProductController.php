<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    
    public function index(Request $request) {
        // インスタンス生成
        $model = new Company();
        /* テーブルから全てのレコードを取得する */
        $companies = $model->getList();
         
        $keyword = $request->input('keyword');
        $company = $request->input('company_name');
         
        $query = Product::query();

        if(!empty($keyword)) {
            $query->where('product_name', 'LIKE', "%{$keyword}%");
            }
        if(!empty($company)) {
                $query->where('company_id', $company);
            }    

        $products = $query->get();
        return view('list', ['products' => $products,'companies' => $companies]);    
    }  //
    
    public function detail($id) {
        $model = new Product();
        $product = $model->getDetail($id);
        return view('detail',['product' => $product]);
    }  ////
    public function edit($id) {
        $model = new Product();
        $product = $model->getDetail($id);
        return view('edited',['product' => $product]);
    }  // //
    
    public function create() {
        $model = new Company();
        $companies = $model->getList();
        return view('create',['companies' => $companies]);
    }  // //
    public function store(Request $request) 
    // フォームから送られたデータを$requestに代入して引数として渡している
    {
        // リクエストされた情報を確認して、必要な情報が全て揃っているかチェックします。
        // ->validate()メソッドは送信されたリクエストデータが特定の条件を満たしていることを確認します。
        $request->validate([
            'product_name' => 'required', 
            'company_id' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'comment' => 'nullable', 
            'img_path' => 'nullable|image|max:2048',
        ]);

        // リクエストに画像が含まれている場合、その画像を保存します。
        if($request->hasFile('img_path')){ 
            $filename = $request->img_path->getClientOriginalName();
            $filePath = $request->img_path->storeAs('products', $filename, 'public');
            $product->img_path = '/storage/' . $filePath;
        }
        
        // 作成したデータベースに新しいレコードとして保存します。
        $product->save();

        // 全ての処理が終わったら、商品一覧画面に戻ります。
        return redirect('products');
    }


    public function registSubmit(ProductRequest $request) {
        
        // トランザクション開始
        DB::beginTransaction();
    
        try {
                //①画像ファイルの取得
        $image = $request->file('img_path');
        
        //②画像ファイルのファイル名を取得
        $file_name = $image->getClientOriginalName();
        
        
        //③storage/app/public/imagesフォルダ内に、取得したファイル名で保存
        $image->storeAs('public/images', $file_name);
        
        //④データベース登録用に、ファイルパスを作成
        $image_path = 'storage/images/' . $file_name;
            // 登録処理呼び出し
            $model = new product();
            $model->registProduct($request,$image_path);
            DB::commit();
        } catch (\Exception $e) {
            
         DB::rollback();
            return back();
        }
    
        // 処理が完了したらregistにリダイレクト
        return redirect(route('index'));
    }
    public function update(Request $request,$id)
    {
        // リクエストされた情報を確認して、必要な情報が全て揃っているかチェックします。
        $request->validate([
            'product_name' => 'required',
            'price' => 'required',
            'stock' => 'required',
        ]);
       
        //バリデーションによりフォームに未入力項目があればエラーメッセー発生させる（未入力です　など）
        //データベースから商品の情報を取り出す。
        $model = new Product();
        $product = $model->find($id);
        // 商品の情報を更新します。
        $product->product_name = $request->product_name;
        //productモデルのproduct_nameをフォームから送られたproduct_nameの値に書き換える
        $product->price = $request->price;
        $product->stock = $request->stock;

        // 更新した商品を保存します。
        $product->save();
        // モデルインスタンスである$productに対して行われた変更をデータベースに保存するためのメソッド（機能）です。

        // 全ての処理が終わったら、商品一覧画面に戻ります。
        return redirect()->route('index')
            ->with('success', 'Product updated successfully');
        // ビュー画面にメッセージを代入した変数(success)を送ります
    }

    public function destroy($id)
    {
        // Booksテーブルから指定のIDのレコード1件を取得
        $product = Product::find($id);
        // レコードを削除
        $product->delete();
        // 削除したら一覧画面にリダイレクト
        return redirect()->route('index');
    }

    
}

