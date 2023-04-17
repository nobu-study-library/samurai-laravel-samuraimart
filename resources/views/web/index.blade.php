@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-2">
      @component('components.sidebar', ['categories' => $categories, 'majorCategories' => $majorCategories])
      @endcomponent
    </div>
    <div class="col-9">
      <h1>おすすめ商品</h1>
      <div class="row">
        @foreach ($recommendProducts as $recommendProduct)
          <div class="col-4">
            <a href="{{ route('products.show', $recommendProduct) }}">
              @if ($recommendProduct->image !== '')
                <img src="{{ asset($recommendProduct->image) }}" class="img-thumbnail">
              @else
                <img src="{{ asset('img/dummy.png') }}" class="img-thumbnail">
              @endif
            </a>
            <div class="row">
              <div class="col-12">
                <p class="samuraimart-product-label mt-2">
                  {{ $recommendProduct->name }}<br>
                  <label>¥{{ $recommendProduct->price }}</label>
                </p>
              </div>
            </div>
          </div>
        @endforeach
      </div>

      <h1>新着商品</h1>
      <div class="row">
        @foreach ($recentlyProducts as $recentlyProduct)
          <div class="col-3">
            <a href="{{ route('products.show', $recentlyProduct) }}">
              @if ($recentlyProduct->image !== '')
                <img src="{{ asset($recentlyProduct->image) }}" class="img-thumbnail">
              @else
                <img src="{{ asset('img/dummy.png') }}" class="img-thumbnail">
              @endif
            </a>
            <div class="row">
              <div class="col-12">
                <p class="samuraimart-product-label mt-2">
                  {{ $recentlyProduct->name }}<br>
                  <label>¥{{ $recentlyProduct->price }}</label>
                </p>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
@endsection
