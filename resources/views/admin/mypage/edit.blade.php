@extends('layouts.admin.app')

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

            <form method="POST" action="{{ route('admin.mypage.update') }}" class="p-5" enctype="multipart/form-data">
                @csrf
                {{-- アバター画像 --}}
                <img-view :initial-image-date="'{{!empty($admin->avatar_file_name)}}'?'/storage/avatars/{{$admin->avatar_file_name}}':'/images/avatar-default.svg'">
                </img-view>
                {{-- ニックネーム --}}
                <div class="md-form mt-3">
                    <label for="name">ニックネーム</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $admin->name) }}" required autocomplete="name" autofocus>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
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