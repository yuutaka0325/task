@extends('layouts.app')
@section('title', '編集画面')
@section('content')

<div class="container">

<h1 class="">商品情報編集画面</h1>


<div class="box">
<form method="POST" action="{{ route('update', ['id'=>$product->id]) }}">
@csrf
<div class="form-area">
<label for="id">ID</label><input type="text" id="id" name="id" value="{{ $product->id }}">
</div>
<div class="form-area">
<label for="product_name">商品名</label><input type="text" id="product_name" name="product_name" value="{{ $product->product_name }}">
    </div>
<div class="form-area">
<label for="company_name">メーカー</label><input type="select" id="company_name" name="company_name" value="{{ $product->company_name }}">
    </div>
<div class="form-area">    
<label for="price">価格</label><input type="text" id="price" name="price" value="{{ $product->price }}">
    </div>
<div class="form-area">
<label for="stock">在庫数</label><input type="text" id="stock" name="stock" value="{{ $product->stock }}">
    </div>
<div class="form-area">
<label for="comment">コメント</label><textarea id="comment" name="comment">{{ $product->comment }}"</textarea>
    </div>
<div class="form-area">
<label for="img_path">商品画像</label><img src="{{ asset($product->img_path) }}" width="100">
    <input type="file" id="img_path" name="img_path">
    </div>
    <div class="button">
    <p><button type="submit" class="create">更新</button></p>
    <p><button type="button" onClick="history.back()" class="move">戻る</button></p>
    </div>




</form>    
</div>
</div>
@endsection
