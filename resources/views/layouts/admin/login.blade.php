<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') |{{ config('app.name', 'Laravel') }}</title>


    <!-- Bootstrap Font Awesome-->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>

<body>
<div id="app">
{{--    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">--}}
    <nav class="navbar navbar-expand-md navbar-light bg-light ">
        <div class="container">
            <a class="navbar-brand col-md-3" href="{{ url('admin/product') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="d-flex col-md-8">
                {{--検索フォーム機能--}}
                    <form class="form-inline" method="GET" action="{{ route('admin.sell.index') }}">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <select class="custom-select" name="brand_category">
                                    <option value="">全て</option>
                                    @foreach ($brand_categories as $category)
                                        <option value="gender:{{$category->id}}" class="font-weight-bold">{{$category->gender}}</option>
                                        @foreach ($category->brand_categories as $brand)
                                            <option value="brand:{{$brand->id}}">　{{$brand->brand_name}}</option>
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group-prepend">
                                <select class="custom-select" name="item_category">
                                    <option value="">全て</option>
                                    @foreach ($item_categories as $category)
                                        <option value="gender:{{$category->id}}" class="font-weight-bold">{{$category->gender}}</option>
                                        @foreach ($category->item_categories as $item)
                                            <option value="item:{{$item->id}}">　{{$item->item_name}}</option>
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>
                            <input type="text" name="keyword" class="form-control" aria-label="Text input with dropdown button" placeholder="キーワード検索">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-outline-dark">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
            </div>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    {{--adminがGuard で 認証されたユーザーだけにアクセス許可していなければ、
                    ログインしなければならない--}}
                    @unless (Auth::guard('admin')->check())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.login') }}">{{ __('Login') }}</a>
                        </li>
                        {{-- 管理者で新規登録 --}}
                        @if (Route::has('admin.register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name ?? '' }} <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('admin.product.create') }}">商品を出品</a>
                                <a class="dropdown-item" href="{{ route('admin.mypage.edit') }}">プロフィール編集</a>
                                <a class="dropdown-item" href="{{ route('admin.logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endunless
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</div>
<!-- Bootstrap Vue JavaScript -->
<script src="{{ mix('js/app.js') }}"></script>
<!-- MDBootstrap JavaScript -->
<script type="text/javascript" src="/js/mdb.min.js"></script>
@yield('script')
</body>

</html>
