@extends('layouts.user.app')

@section('title')
{{ $product->name }}
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8 offset-2 bg-white">


            @include('user.product.product_detail_panel', [
            'product', $product
            ])
            @if($product->isStateSelling)
            <form method="POST" action="{{ route('user.line_item.create') }}" class="">
                @csrf
                <input type="hidden" name="id" value="{{ $product->id }}" />
                <div class="row justify-content-center">
                    <div class="product__quantity col-2 mr-4">
                        <input type="number" name="quantity" min="1" value="1" class="form-control" require />
                    </div>
                    <div class="product__btn-add-cart col-4 ml-4">
                        <button type="submit" class="btn btn-outline-secondary ">カートに追加する</button>
                    </div>
                </div>
            </form>
            @endif
            <div class="my-3 text-center">
                <h4>商品説明 : {!! nl2br(e($product->description)) !!}</h4>
            </div>
        </div>
    </div>
</div>
@endsection