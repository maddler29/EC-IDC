@extends('layouts.app')

@section('title')
商品出品
@endsection

@section('content')
<div class="container">

    <div class="row">
        <div class="col-8 offset-2 bg-white">

            <div class="font-weight-bold text-center border-bottom pb-3 pt-3" style="font-size: 24px">商品を出品する</div>

                <form method="POST" action="{{ route('admin.store') }}" class="p-5" enctype="multipart/form-data">
                    @include('admin.sell.form')
                    <div class="form-group mb-0 mt-3">
                        <button type="submit" class="btn btn-block btn-primary">
                            出品する
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection