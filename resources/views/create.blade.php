@extends('layouts.app')
@section('title', '新規登録画面')
@section('content')
<div class="container">


<h1 class="">商品新規登録画面</h1>


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
<form method="POST" action="{{ route('submit') }}" enctype="multipart/form-data">
@csrf

    <div class="form-area">
    <label for="product_name">商品名</label><input type="text" name="product_name" value="{{ old('product_name') }}">
    @if($errors->has('product_name'))
        <p>{{ $errors->first('product_name') }}</p>
    @endif
    </div>

    <div class="form-area">
    <label for="company_name">メーカー</label><select name="company_name" value="{{ old('company_name') }}">
    @if($errors->has('company_name'))
     <p>{{ $errors->first('company_name') }}</p>
    @endif
    </div>
    @foreach ($companies as $company)
    <option value="{{ $company->id }}">{{ $company->company_name }}</option>   
    @endforeach
    </select>

    <div class="form-area">
    <label for="price">価格</label><input type="text" name="price" value="{{ old('price') }}">
    @if($errors->has('price'))
    <p>{{ $errors->first('price') }}</p>
    @endif
    </div>

    <div class="form-area">
    <label for="stock">在庫数</label><input type="text" name="stock" value="{{ old('stock') }}">
    @if($errors->has('stock'))
    <p>{{ $errors->first('stock') }}</p>
    @endif
    </div>

    <div class="form-area">
    <label for="comment">コメント</label><textarea name="comment"></textarea>
    </div>

    <div class="form-area">
    <label for="img_path">商品画像</label><input type="file" name="img_path" >
    </div>
    
    <div class="button">
    <p><button type="submit" class="btn create" >新規登録</button></p>
    <p><button type="button" onClick="history.back()" class="move">戻る</button></p>
    </div>

</form>    

</div>
</div>
@endsection