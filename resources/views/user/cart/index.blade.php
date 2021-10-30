@extends('layouts.user.app')

@section('title')
カート
@endsection

@section('content')
<div class="container">
    <div class="cart__title">
        <h3>Shopping Cart</h3>
    </div>
    @if(count($line_items) > 0)
    <div class="cart-wrapper">
        @foreach ($line_items as $item)
        <div class="card mb-3 ">
            <div class="row ">
                <img src="/storage/avatars/{{$item->image}}" alt="{{ $item->name }}" class="product-cart-img" />
                <div class="card-body d-inline-flex">
                    <div class="card-product-name col-4">
                        <h5> {{ $item->name }}</h5>
                    </div>
                    <div class="card-quantity col-2">
                        <h5>{{ $item->pivot->quantity }}個</h5>
                    </div>
                    <div class="card__total-price col-4 text-center">
                        <h5>￥{{ number_format($item->price * $item->pivot->quantity) }}</h5>
                    </div>
                    {{--カート画面にゴミ箱アイコンを追加--}}
                    <form method="post" action="{{ route('user.line_item.delete') }}">
                        @csrf
                        <div class="col-2offset-md-2 ">
                            <input type="hidden" name="id" value="{{ $item->pivot->id }}" />
                            <button type="submit" class="fas fa-trash-alt btn  btn-light"></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="cart__sub-total">
        <h3> 小計：￥{{ number_format($total_price) }} 円</h3>
    </div>
    <button onClick="location.href='{{ route('user.cart.checkout') }}'" class="cart__purchase btn btn-primary">
        購入する
    </button>
    @else
    <div class="cart__empty">
        カートに商品が入っていません。
    </div>
    @endif
</div>
@endsection
@extends('layouts.user.footer')
