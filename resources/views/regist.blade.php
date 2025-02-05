@extends('layouts.app')

@section('title', '投稿画面')

@section('content')
    <div class="container">
        <div class="row">
            <h1>ユーザーログイン画面</h1>
            <form action="{{ route('submit') }}" method="post">
                @csrf

                <div class="form-group">
                    <label for="title">商品名</label>
                    <input type="text" value="{{ old('product_name') }}">
                    @if($errors->has('product_name'))
                        <p>{{ $errors->first('product_name') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="title">メーカー</label>
                    <input type="text" value="{{ old('company_name') }}">
                    @if($errors->has('company_name'))
                        <p>{{ $errors->first('company_name') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="title">価格</label>
                    <input type="text" value="{{ old('price') }}">
                    @if($errors->has('price'))
                        <p>{{ $errors->first('price') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="title">在庫数</label>
                    <input type="text" value="{{ old('stock') }}">
                    @if($errors->has('stock'))
                        <p>{{ $errors->first('stock') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="title">コメント</label>
                    <textarea class="form-control">{{ old('comment') }}</textarea>
                    @if($errors->has('comment'))
                        <p>{{ $errors->first('title') }}</p>
                    @endif
                </div>

                

                <button type="submit" class="btn btn-default">新規登録</button>
                <button type="submit" class="btn btn-default">ログイン</button>
            </form>
        </div>
    </div>
@endsection