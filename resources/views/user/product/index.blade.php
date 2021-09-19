@extends('layouts.user.app')

@section('title')
商品一覧
@endsection

@section('content')
<div class="jumbotron top-img">
    <p class="text-center text-white top-img-text">{{ config('app.name', 'Laravel') }}</p>
</div>

<div class="container">
    <div class="top__title text-center">
        All Products
    </div>
    <div class="row">
        @foreach( $products as $product )
        <a href="{{ route('user.product.show', $product->id) }}" class="col-lg-4 col-md-6">
            <div class="card">
                <img src=" /storage/avatars/{{$product->image}}" class="card-img">
                <div class="card-body">
                    <p class="card-title">{{ $product->name }}</p>
                    <p class="card-text">サイズ : {{ $product->size }}</p>
                    @if(($product->item_categories->gender_id ) == 1)
                    <p>Men's</p>
                    @else
                    <P>Wemen's</P>
                    @endif
                    <p class="card-text">¥{{ number_format($product->price) }}</p>

                    {{-- name,size,image,gender_category,item_category,brand_category--}}
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endsection