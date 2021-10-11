@extends('layouts.user.app')

@section('title')
プロフィール編集
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8 offset-2">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-8 offset-2 bg-white">

            <div class="font-weight-bold text-center border-bottom pb-3 pt-3" style="font-size: 24px">プロフィール編集</div>
            @if (Auth::id() == 2)
            <div class="alert alert-success" role="alert">
                ※ゲストユーザーは、ユーザー名を編集できません。
            </div>
            @endif

            <form method="POST" action="{{ route('user.mypage.update') }}" class="p-5" enctype="multipart/form-data">
                @csrf
                {{-- アバター画像 --}}
                @if (Auth::id() == 2)
                @else
                <img-view :initial-image-date="'{{!empty($user->avatar_file_name)}}'?'/storage/avatars/{{$user->avatar_file_name}}':'/images/avatar-default.svg'">
                </img-view>
                @endif
                {{-- ニックネーム --}}
                <div class="md-form mt-3">
                    <label for="name">ニックネーム</label>
                    @if (Auth::id() == 2)
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required autocomplete="name" readonly>
                    @else
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" required autocomplete="name" autofocus>
                    @endif

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <input type="hidden" name="remember" id="remember" value="on">
                <div class="text-left">
                    <a class="card-text text-primary" href="{{route('user.password.request')}}">パスワードを再設定</a>
                </div>

                <div class="form-group mb-0 mt-3">
                    <button type="submit" class="btn btn-block btn-primary">
                        保存
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection