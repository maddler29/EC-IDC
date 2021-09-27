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
            <p> 商品説明 : {{ $product->description }}</p>
            <p> サイズ : {{ $product->size }}</p>
            <p> 材質 : {{ $product->material }} </p>
            <div class="card__gender col-md-6 text-nowrap">
                @if(($product->item_categories->gender_id ) == 1)
                <p>性別 : Men's</p>
                @else
                <P>性別 : Wemen's</P>
                @endif
            </div>

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