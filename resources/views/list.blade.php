@extends('layouts.app')

 

@section('title', '商品一覧')

 

@section('content')

<div class="container">
    <h1 class="">商品一覧画面</h1>
    
     
     <form action="{{ route('index') }}" method="GET">
    @csrf
    <input type="text" name="keyword" class="form-control" placeholder="商品名" value="{{ request('$keyword') }}">
    <select name="company_name" required>
    @foreach ($companies as $company)
    <option value="{{ $company->id }}">{{ $company->company_name }}</option>   
    @endforeach
    </select>
    
   
    <input type="submit" value="検索">
    </form>
    <div class="box">
  <table>
     <thead>
        <tr>
            <th>ID</th>
            <th>商品画像</th>
            <th>商品名</th>
            <th>価格</th>
            <th>在庫数</th>
            <th>メーカー名</th>
            <th><button onclick="location.href='{{ route('create') }}'" class="create">新規登録</button></th>
            
            

            
        </tr>
    </thead>
    <tbody>
    @foreach ($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td><img src="{{ asset($product->img_path) }}" width="30"></td>
            <td>{{ $product->product_name }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->stock }}</td>
            <td>{{ $product->company->company_name }}</td>
            <td><button onclick="location.href='{{ route('detail', ['id'=>$product->id]) }}'" class="move">詳細</button></td>
            <td>
                <form method="POST" action="{{ route('destroy', ['id'=>$product->id]) }}">
                @csrf
                
                <button type="submit" class="btn btn-danger delete">削除</button>
                </form>
            </td>
            

            

        </tr>
    @endforeach
    </tbody>
  </table>
</div> 
</div>
@endsection