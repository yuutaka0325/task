@extends('layouts.app')
@section('title', '詳細画面')
@section('content')
<div class="container">


<h1 class="">商品情報詳細画面</h1>


<div class="box">
    <div class="detail-box">
    <p>ID</p><td>{{ $product->id }}</td>
    <p>商品画像<td><img src="{{ asset($product->img_path) }}" width="100"></td></p>
    <p>商品名<td>{{ $product->product_name }}</td></p>
    <p>価格<td>¥{{ $product->price }}</td></p>
    <p>在庫<td>{{ $product->stock }}</td></p>
    <p>コメント<td>{{ $product->comment }}</td></p>
    </div>
    <div class="button">
    <p><button onclick="location.href='{{ route('edit', ['id'=>$product->id]) }}'" class="create">編集</button></p>
    <p><button type="button" onClick="history.back()" class="move">戻る</button></p>
    </div>

</div>
@endsection
