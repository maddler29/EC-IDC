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
        <div class="col-3 mb-3">
            <a href="{{ route('user.product.show', $product->id) }}" class="  d-inline-block d-flex justify-content-center align-items-center flex-column" role="button" style="  border-radius: 75px;">
                <div class="card">
                    <div class="position-relative overflow-hidden">
                        <img src=" /storage/avatars/{{$product->image}}" class="card-image ">
                        <div class="position-absolute py-2 px-3" style="left: 0; bottom: 10px; color: white; background-color: rgba(0, 0, 0, 0.70)">
                            <i class="fas fa-yen-sign"></i>
                            <span class="ml-1">{{number_format($product->price)}}</span>
                        </div>

                        @if ($product->isStateBought)
                        <div class=" position-absolute py-1 font-weight-bold d-flex justify-content-center align-items-end" style="left: 0; top: 0; color: white; background-color: #EA352C; transform: translate(-50%,-50%) rotate(-45deg); width: 125px; height: 125px; font-size: 20px;">
                            <span>SOLD</span>
                        </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <p class="card-text">{{ $product->name }}</p>
                        <p class="card-text">サイズ : {{ $product->size }}</p>
                        @if(($product->item_categories->gender_id ) == 1)
                        <p>Men's</p>
                        @else
                        <P>Wemen's</P>
                        @endif


                        {{-- name,size,image,gender_category,item_category,brand_category--}}
                    </div>
                </div>


            </a>
        </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center">
        {{ $products->links() }}
    </div>
</div>
@endsection