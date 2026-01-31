<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>@yield('title', 'EkspImpor - Export Import Solutions')</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  {{-- Memanggil CSS, Favicons, dll. --}}
  @include('partials.href')

</head>
<body class="@yield('body_class', 'index-page')">

  {{-- Memanggil Header (Navigasi) --}}
  @include('partials.header')

  <main class="main">

    {{-- Ini adalah "lubang" yang akan diisi oleh welcome.blade.php --}}
    @yield('content')

  </main>

  {{-- Memanggil Footer --}}
  @include('partials.footer')

  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <div id="preloader"></div>

  {{-- Memanggil semua file JavaScript --}}
  @include('partials.script')

</body>
</html>
