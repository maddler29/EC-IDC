<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>@yield('title') | {{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
</head>
<body>
<nav class="navbar navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="/">{{ config('app.name', 'Laravel') }}</a>
        {{--カート画面へのリンク作成--}}
        <a class="fas fa-shopping-cart" href="{{ route('cart.index') }}"></a>
    </div>
    <div>
        {{--出品画面へのリンク作成--}}
        <a class="fas fa-camera" href="{{ route('product.sell') }}">商品を出品する</a>
    </div>
</nav>
@yield('content')
</body>
</html>
