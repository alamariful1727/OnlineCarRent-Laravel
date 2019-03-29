<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <base href="{{ URL::asset('/') }}"> {{-- target="_blank" --}}
  <!-- Scripts -->
  {{--
  <script src="{{ asset('js/app.js') }}" defer></script> --}}
  <script src="{{ url('js/jquery-3.3.1.min.js')}}"></script>
  <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
  <script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

  <!-- Styles -->
  {{--
  <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}} {{--
  <link rel="stylesheet" href="{{ url('css/app.css') }}"> --}}
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
  <link rel="stylesheet" href="{{ asset('css/gijgo.min.css') }}" />

</head>

<body>
  <style>
    body {
      background: #ED4264;
      /* fallback for old browsers */
      background: -webkit-linear-gradient(to right, #FFEDBC, #ED4264);
      /* Chrome 10-25, Safari 5.1-6 */
      background: linear-gradient(to right, #FFEDBC, #ED4264);
      /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    }
  </style>
  <div class="loader-wrapper">
    <span class="loader"><span class="loader-inner"></span></span>
  </div>
  <button id="scrollTop" class="btn btn-outline-dark"><i class="fas fa-angle-up"></i></button>
  <div id="app">
    <main class="py-4 mt-5">
  @include('inc.navbar')
  @include('inc.msg') @yield('content')
    </main>
  </div>
</body>

<script src="{{ url('js/gijgo.min.js')}}"></script>
<script src="{{ url('js/bootstrap.min.js')}}"></script>
<script src="{{ url('js/axios.min.js')}}"></script>
<script src="{{ url('js/owl.carousel.min.js')}}"></script>
<script src="{{ url('js/fa.js')}}"></script>
<script src="{{ url('js/main.js')}}"></script>

</html>