@extends('layouts.app')

@section('title', '商品一覧')

@section('content')

<div class="container">
    <h1 class="">商品一覧画面</h1>
    
    <div class="search"> 
        <form action="{{ route('index') }}" method="GET" id="search-form">
            @csrf
            <input type="text" name="keyword" class="form-control" placeholder="商品名" value="{{ request('$keyword') }}">
            <select name="company_name" required>
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->company_name }}</option>   
                @endforeach
            </select>
        <div class="price_search">
            <label for="price">{{ __('価格') }}</label>

            <div class="jougen">
                <p>{{ __('上限') }}</p>
                <input type="number" name="jougenprice" id="jougenprice" >
            </div>

            <div class="kagen">
                <p>{{ __('下限') }}</p>
                <input type="number" name="kagenprice" id="kagenprice" >
            </div>

        </div>

        <div class="stock.serach">
            <label for="stock">{{ __('在庫数') }}</label>

            <div class="jougen">
                <p>{{ __('上限') }}</p>
                <input type="number" name="jougenstock" id="jougenstock" >
            </div>

            <div class="kagen">
                <p>{{ __('下限') }}</p>
                <input type="number" name="kagenstock" id="kagenstock" >
            </div>

        </div>
            <input type="submit" value="検索" id="search-btn">
        </form>
    </div>
    <div class="list-box">
        <table>
            <thead>
                <tr>
                    <th>@sortablelink('id', 'ID')</th>
                    <th>@sortablelink('img_path', '商品画像')</th>
                    <th>@sortablelink('product_name', '商品名')</th>
                    <th>@sortablelink('price', '価格')</th>
                    <th>@sortablelink('stock', '在庫数')</th>
                    <th>@sortablelink('comapnay_name', 'メーカー名')</th>
                    <th><button onclick="location.href='{{ route('create') }}'" class="create">新規登録</button></th>
                </tr>
            </thead>
            
             <tbody  class="list">
                @foreach ($products as $product)
                <tr>
                    <td class="list">{{ $product->id }}</td>
                    <td class="list"><img src="{{ asset($product->img_path) }}" width="30"></td>
                    <td class="list">{{ $product->product_name }}</td>
                    <td class="list">¥{{ $product->price }}</td>
                    <td class="list">{{ $product->stock }}</td>
                    <td class="list">{{ $product->company_name }}</td>
                    <td><button onclick="location.href='{{ route('detail', ['id'=>$product->id]) }}'" class="move">詳細</button></td>
                    <td>
                        <form method="POST" action="{{ route('destroy', ['id'=>$product->id]) }}">
                        @csrf
                        
                        <button type="submit" class="btn btn-danger delete" onclick='return confirm("本当に削除しますか？")'>削除</button>

                        </form>
                    </td>
            

            

                </tr>
                    @endforeach
             </tbody>
  </table>
</div> 
</div>
@endsection