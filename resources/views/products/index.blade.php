@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-2">
      @component('components.sidebar', [
          'categoryList' => $categoryList,
          'majorCategoryNameList' => $majorCategoryNameList,
      ])
      @endcomponent
    </div>

    <div class="col-9">
      <div class="container mt-4">
        <div class="row w-100">
          @foreach ($productList as $product)
            <div class="col-3">
              <a href="{{ route('products.show', $product) }}">
                <img src="{{ asset('img/dummy.png') }}" class="img-thumbnail">
              </a>
              <div class="row">
                <div class="col-12">
                  <p class="samuraimart-product-label mt-2">
                    {{ $product->name }}<br>
                    <label>¥{{ $product->price }}</label>
                  </p>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
      {{ $productList->links() }}
    </div>
  </div>
@endsection
