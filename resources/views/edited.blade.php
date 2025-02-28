@extends('layouts.app')
@section('title', '編集画面')
@section('content')

<div class="container">

<h1 class="">商品情報編集画面</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<div class="box">
<form method="POST" action="{{route('update', ['id'=>$product->id])}}" enctype="multipart/form-data"> 
@csrf
<div class="form-area">
<label for="id">ID</label><input type="text" id="id" name="id" value="{{ $product->id }}">
    </div>
<div class="form-area">
<label for="product_name">商品名</label><input type="text" id="product_name" name="product_name" value="{{ $product->product_name }} {{ old('product_name') }}">
@if($errors->has('product_name'))
 <p>{{ $errors->first('product_name') }}</p>
@endif
    </div>
<div class="form-area">
<label for="company_name">メーカー</label><input type="select" id="company_name" name="company_name" value="{{ $product->company_name }} {{ old('company_name') }}">
@if($errors->has('company_name'))
 <p>{{ $errors->first('company_name') }}</p>
@endif
    </div>
<div class="form-area">    
<label for="price">価格</label><input type="text" id="price" name="price" value="{{ $product->price }} {{ old('price') }}">
@if($errors->has('price'))
    <p>{{ $errors->first('price') }}</p>                
@endif
    </div>
<div class="form-area">
<label for="stock">在庫数</label><input type="text" id="stock" name="stock" value="{{ $product->stock }} {{ old('stock') }}">
@if($errors->has('stock'))
    <p>{{ $errors->first('stock') }}</p>
@endif
    </div>
<div class="form-area">
<label for="comment">コメント</label><textarea id="comment" name="comment">{{ $product->comment }}"</textarea>
    </div>
<div class="form-area">
<label for="img_path">商品画像</label><img src="{{ asset($product->img_path) }}" width="30">
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
