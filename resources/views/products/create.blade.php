@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>新しい商品を追加</h1>

    <form action="P{{ route('products.store') }}" method="post">
      @csrf
      <div class="form-group">
        <label for="productName">商品名</label>
        <input type="text" name="name" id="productName" class="form-control">
      </div>
      <div class="form-group">
        <label for="productDescription">商品説明</label>
        <textarea name="description" id="productDescription" class="form-control"></textarea>
      </div>
      <div class="form-group">
        <label for="productPrice">価格</label>
        <input type="number" name="price" id="productPrice" class="form-control">
      </div>
      <div class="form-group">
        <label for="productCategory">カテゴリ</label>
        <select name="categoryId" id="productCategory" class="form-control">
          @foreach ($categoryList as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
          @endforeach
        </select>
      </div>
      <button type="submit" class="btn btn-success">商品を登録</button>
    </form>

    <a href="{{ route('products.index') }}">商品一覧に戻る</a>
  </div>
@endsection
