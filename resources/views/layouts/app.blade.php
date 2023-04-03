<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

  <!-- Scripts -->
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])
  <script src="https://kit.fontawesome.com/566b522bd3.js" crossorigin="anonymous"></script>

  <!-- Styles -->
  <link rel="stylesheet" href="{{ asset('css/samuraimart.css') }}">
</head>

<body>
  <div id="app">
    @component('components.header')
    @endcomponent

    <main class="mb-5 py-4">
      @yield('content')
    </main>
  </div>
</body>

</html>
