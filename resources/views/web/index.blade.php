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
        <div class="col-4">
          <a href="#">
            <img src="{{ asset('img/chestnut.jpg') }}" class="img-thumbnail">
          </a>
          <div class="row">
            <div class="col-12">
              <p class="samuraimart-product-label mt-2">
                和栗の詰め合わせ<br>
                <label>¥2000</label>
              </p>
            </div>
          </div>
        </div>
        <div class="col-4">
          <a href="#">
            <img src="{{ asset('img/persimmon.jpg') }}" class="img-thumbnail">
          </a>
          <div class="row">
            <div class="col-12">
              <p class="samuraimart-product-label mt-2">
                おいしい柿<br>
                <label>¥500</label>
              </p>
            </div>
          </div>
        </div>
        <div class="col-4">
          <a href="#">
            <img src="{{ asset('img/orange.jpg') }}" class="img-thumbnail">
          </a>
          <div class="row">
            <div class="col-12">
              <p class="samuraimart-product-label mt-2">
                旬なみかん<br>
                <label>¥1200</label>
              </p>
            </div>
          </div>
        </div>
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
