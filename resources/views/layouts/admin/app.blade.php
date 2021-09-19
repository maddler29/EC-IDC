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
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('admin/product') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li>
                            {{--出品画面へのリンク作成--}}
                            <a class="fas fa-camera" href="{{ route('admin.product.create') }}">商品を出品する</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.mypage.edit') }}">
                                プロフィール編集
                            </a>
                        </li>
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
<<<<<<< HEAD
                        {{-- 検索フォーム --}}
                        <form class="form-inline" method="GET" action="{{ route('admin.home.index') }}">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <select class="custom-select" name="category">
                                        <option value="">全て</option>
                                        {{-- @foreach ($brand_categories as $category)
                                        <option value="gender:{{$category->id}}" class="font-weight-bold">{{$category->gender}}</option>
                                        @foreach ($category->brand_categories as $brand)
                                        <option value="brand:{{$brand->id}}">　{{$brand->brand_name}}</option>
                                        @endforeach
                                        @endforeach --}}
                                    </select>
                                </div>
                            </div>
                        </form>
                        <form class="form-inline" method="GET" action="{{ route('admin.home.index') }}">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <select class="custom-select" name="category">
                                        <option value="">全て</option>
                                        {{--@foreach ($item_categories as $category)
                                        <option value="gender:{{$category->id}}" class="font-weight-bold">{{$category->gender}}</option>
                                        @foreach ($category->item_categories as $item)
                                        <option value="item:{{$item->id}}">　{{$item->item_name}}</option>
                                        @endforeach
                                        @endforeach--}}
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


=======
>>>>>>> 1651110a675701f5ef08e3af8fe15e06b46b3daf
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