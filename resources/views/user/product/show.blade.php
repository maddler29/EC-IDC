@extends('layouts.user.app')

@section('title')
{{ $product->name }}
@endsection

@section('content')
<div class="container">
    <div class="product">
        <img src=" /storage/avatars/{{$product->image}}" class="product-img" />
        <div class="product__content-header text-center">
            <div class="product__name">
                {{ $product->name }}
            </div>
            <p>¥{{ number_format($product->price) }}</p>
            <p> {{ $product->description }}</p>
        </div>
        {{-- size,material,item_category,gender_category,brand_category--}}

        <form method="POST" action="{{ route('user.line_item.create') }}">
            @csrf
            <input type="hidden" name="id" value="{{ $product->id }}" />
            <div class="product__quantity">
                <input type="number" name="quantity" min="1" value="1" require />
            </div>
            <div class="product__btn-add-cart">
                <button type="submit" class="btn btn-outline-secondary">カートに追加する</button>
            </div>
    </div>
</div>
@endsection