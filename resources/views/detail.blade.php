@extends('layouts.app')
@section('title', '詳細画面')
@section('content')
<div class="container">


<h1 class="">商品情報詳細画面</h1>


<div class="box">
    <div class="detail-box">
    <table>
        <tbody>
            <tr>
                <th>ID</th>
                    <td>{{ $product->id }}</td>
                
            </tr>
            <tr>
                <th>商品画像</th>
                    <td><img src="{{ asset($product->img_path) }}" width="60"></td>
                
            </tr>
            <tr>
                <th>商品名</th>
                    <td>{{ $product->product_name }}</td>
                
            </tr>
            <tr>
                <th>価格</th>
                    <td>¥{{ $product->price }}</td>
                
            </tr>
            <tr>
                <th>在庫</th>
                    <td>{{ $product->stock }}</td>
                
            </tr>
            <tr>
                <th>コメント</th>
                    <td>{{ $product->comment }}</td>
                
            </tr>
            
        </tbody>
    </table>
    </div>
    <div class="button">
    <p><button onclick="location.href='{{ route('edit', ['id'=>$product->id]) }}'" class="create">編集</button></p>
    <p><button type="button" onClick="history.back()" class="move">戻る</button></p>

    </div>

</div>
@endsection
