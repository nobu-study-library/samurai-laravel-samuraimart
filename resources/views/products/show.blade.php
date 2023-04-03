@extends('layouts.app')

@section('content')
  <div class="d-flex justify-content-center">
    <div class="row w-75">
      <div class="col-5 offset-1">
        <img src="{{ asset('img/dummy.png') }}" class="w-100 img-fluid">
      </div>
      <div class="col">
        <div class="d-flex flex-column">
          <h1>
            {{ $product->name }}
          </h1>
          <p>
            {{ $product->description }}
          </p>
          <hr>
          <p class="d-flex align-items-end">
            ¥{{ $product->price }}（税込み）
          </p>
          <hr>
        </div>

        @auth
          <form method="post" class="align-items-end m-3">
            @csrf
            <input type="hidden" name="id" value="{{ $product->id }}">
            <input type="hidden" name="name" value="{{ $product->name }}">
            <input type="hidden" name="price" value="{{ $product->price }}">
            <div class="form-group row">
              <label for="quantity" class="col-sm-2 col-form-label">数量</label>
              <div class="col-sm-10">
                <input type="number" name="qty" min="1" value="1" id="quantity" class="form-control">
              </div>
            </div>
            <input type="hidden" name="weight" value="0">
            <div class="row">
              <div class="col-7">
                <button type="submit" class="btn samuraimart-submit-button w-100">
                  <i class="fas fa-shopping-cart"></i>
                  カートに追加
                </button>
              </div>
              <div class="col-5">
                <a href="/products/{{ $product->id }}/favorite" class="btn samuraimart-favorite-button text-dark w-100">
                  <i class="fa fa-heart">お気に入り</i>
                </a>
              </div>
            </div>
          </form>
        @endauth
      </div>

      <div class="offset-1 col-11">
        <hr class="w-100">
        <h3 class="float-left">カスタマーレビュー</h3>
      </div>

      <div class="offset-1 col-10">
        {{-- レビューの機能実装 --}}
      </div>
    </div>
  </div>
@endsection
