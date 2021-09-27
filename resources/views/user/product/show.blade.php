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

            <form method="POST" action="{{ route('user.line_item.create') }}">
                @csrf
                <input type="hidden" name="id" value="{{ $product->id }}" />
                <div class="product__quantity">
                    <input type="number" name="quantity" min="1" value="1" require />
                </div>
                <div class="product__btn-add-cart text-center">
                    <button type="submit" class="btn btn-outline-secondary">カートに追加する</button>
                </div>
            </form>
            <div class="my-3 text-center">
                <h4>{!! nl2br(e($product->description)) !!}</h4>
            </div>
        </div>
    </div>
</div>
@endsection