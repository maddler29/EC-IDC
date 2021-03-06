@extends('layouts.user.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">
            <h1 class="text-center"><a class="text-dark" href="/">EC-IDC</a></h1>
            <div class="card mt-3">
                <div class="card-body text-center">
                    <h2 class="h3 card-title text-center mt-2">ログイン</h2>
                    @include('layouts.error_card_list')
                    <div class="card-text">
                        <form method="POST" action="{{ route('user.login') }}">
                            @csrf
                            <div class="md-form">
                                <label for="email">メールアドレス</label>
                                <input class="form-control" type="text" id="email" name="email" required value="{{ old('email') }}">
                            </div>
                            <div class="md-form">
                                <label for="password">パスワード</label>
                                <input class="form-control" type="password" id="password" name="password" required>
                            </div>
                            <input type="hidden" name="remember" id="remember" value="on">
                            <div class="text-left">
                                <a class="card-text" href="{{route('user.password.request')}}">パスワードを忘れた方はこちら</a>
                            </div>
                            <button class="btn btn-block btn-primary mt-2 mb-2" type="submit">ログイン</button>
                        </form>
                        <button class="btn btn-success">
                            <a href="{{ route('user.login.guest') }}" class="text-white">
                                ゲストログイン
                            </a>
                        </button>
                        <div class="mt-0">
                            <a href="{{ route('user.register') }}" class="card-text">ユーザー登録はこちら</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection