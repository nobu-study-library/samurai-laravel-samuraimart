<nav class="navbar navbar-expand-md navbar-light samuraimart-header-container shadow-sm">
  <div class="container">
    <a class="navbar-brand" href="{{ url('/') }}">
      <img src="{{ asset('img/logo.jpeg') }}">
    </a>
    <form class="row g-1">
      <div class="col-auto">
        <input class="form-control samuraimart-header-search-input">
      </div>
      <div class="col-auto">
        <button type="submit" class="btn samuraimart-header-search-button"><i
            class="fas fa-search samuraimart-header-search-icon"></i></button>
      </div>
    </form>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse collapse" id="navbarSupportedContent">
      <!-- Right Side Of Navbar -->
      <ul class="navbar-nav ms-auto mr-5 mt-2">
        <!-- Authentication Links -->
        @guest
          <li class="nav-item mr-5">
            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
          </li>
          <li class="nav-item mr-5">
            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
          </li>
          <hr>
          <li class="nav-item mr-5">
            <a class="nav-link" href="{{ route('login') }}"><i class="far fa-heart"></i></a>
          </li>
          <li class="nav-item mr-5">
            <a class="nav-link" href="{{ route('login') }}"><i class="fas fa-shopping-cart"></i></a>
          </li>
        @else
          <li class="nav-item mr-5">
            <a href="{{ route('mypage') }}" class="nav-link">
              <i class="fas fa-user mr-1"><label>マイページ</label></i></a>
          </li>
          <li class="nav-item mr-5">
            <a href="{{ route('mypage.favorite') }}" class="nav-link">
              <i class="far fa-heart"></i>
            </a>
          </li>
          <li class="nav-item mr-5">
            <a href="{{ route('carts.index') }}" class="nav-link">
              <i class="fas fa-shopping-cart"></i>
            </a>
          </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>
