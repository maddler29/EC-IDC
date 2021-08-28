@extends('layouts.admin.app')

@section('title')
    商品更新
@endsection

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-8 offset-2 bg-white">

                <div class="font-weight-bold text-center border-bottom pb-3 pt-3" style="font-size: 24px">商品更新</div>

                <form method="POST" action="{{ route('admin.product.update') }}" class="p-5" enctype="multipart/form-data">
                    @method('PATCH')
                    @include('admin.sell.form')
                    <div class="form-group mb-0 mt-3">
                        <button type="submit" class="btn btn-block btn-primary">
                            更新する
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
c
