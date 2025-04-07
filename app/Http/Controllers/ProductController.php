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

    public function index(Request $request)
    {

        $model = new Company();

        $companies = $model->getList();

        $productModel = new Product();

        $query = Product::query();
        $products = $query->paginate(10)->appends($request->query());

        return view('list', ['products' => $products, 'companies' => $companies,]);
    }
    public function search(Request $request)
    {
        Log::info('リクエスト情報', [

            'URL' => $request->fullUrl(),

            'Method' => $request->method(),

            'Headers' => $request->headers->all(),

            'Body' => $request->all(),

        ]);
        try {

            $model = new Company();
            $companies = $model->getList();

            $keyword = $request->input('keyword');
            $company = $request->input('company_name');

            $min_price = $request->input('kagenprice');
            $max_price = $request->input('jougenprice');
            $min_stock = $request->input('kagenstock');
            $max_stock = $request->input('jougenstock');

            $productModel = new Product();
            $products = $productModel->getList($keyword, $company, $min_price, $max_price, $min_stock, $max_stock);


        } catch (\Exception $e) {

            Log::error('エラー発生', [

                'message' => $e->getMessage(),

                'file' => $e->getFile(),

                'line' => $e->getLine(),

                'trace' => $e->getTraceAsString(),

            ]);

        }


        return response()->json($products);
    }

    public function detail($id)
    {
        $model = new Product();
        $product = $model->getDetail($id);
        return view('detail', ['product' => $product]);
    }
    public function edit($id)
    {
        $model = new Product();
        $product = $model->getDetail($id);
        return view('edited', ['product' => $product]);
    }

    public function create()
    {
        $model = new Company();
        $companies = $model->getList();
        return view('create', ['companies' => $companies]);
    }

    public function registSubmit(ProductRequest $request)
    {

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
            $model->registProduct($request, $image_path);
            DB::commit();
        } catch (\Exception $e) {

            DB::rollback();
            return back();
        }

        // 処理が完了したらregistにリダイレクト
        return redirect(route('index'));
    }
    public function update(ProductRequest $request, $id)
    {

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

            //データベースから商品の情報を取り出す。
            $model = new Product();
            $product = $model->find($id);
            // 商品の情報を更新
            $product->product_name = $request->product_name;
            //productモデルのproduct_nameをフォームから送られたproduct_nameの値に書き換える。
            $product->price = $request->price;
            $product->stock = $request->stock;
            $product->img_path = $image_path;

            $product->save();
            // モデルインスタンスである$productに対して行われた変更をデータベースに保存。
            DB::commit();
        } catch (\Exception $e) {

            DB::rollback();
            return back();
        }

        // 全ての処理が終わったら、商品一覧画面に戻ります。
        return redirect()->route('index')
            ->with('success', 'Product updated successfully');
        // ビュー画面にメッセージを代入した変数(success)を送る
    }

    public function destroy($id)
    {
        // トランザクション開始
        DB::beginTransaction();

        try {
            // Booksテーブルから指定のIDのレコード1件を取得
            $product = Product::find($id);
            Log::info($id);
            Log::info($product);
            // レコードを削除
            $product->delete();
            DB::commit();
        } catch (\Exception $e) {

            DB::rollback();
            return back();
        }
        // 削除したら一覧画面にリダイレクト
        //return redirect()->route('index');
        return response()->json($product);

    }


}

