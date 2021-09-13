@extends('layouts.admin.app')

@section('title')
一覧
@endsection

@section('content')
<div class="container">
    <div class="sell__title">
        Product List
    </div>
    @if(!empty($items))
    <div class="sell-wrapper">
        @foreach ($items as $item)
        <div class="card mb-3">
            <div class="row">
                <img src="{{ asset($item->image) }}" alt="{{ $item->name }}" class="product-cart-img" />
                <div class="card-body">
                    <div class="card-product-name col-6">
                        商品名:{{ $item->name }}
                    </div>
                    <div class="card-quantity col-2">
                        {{-- {{ $item->line_item->quantity }}個 --}}
                    </div>
                    <div class="card__total-price col-3 text-center">
                        ¥{{ number_format($item->price) }}
                    </div>
                    {{--カート画面にゴミ箱アイコンを追加--}}
                    <form method="post" action="{{ route('admin.sell.destroy', $item->id) }}">
                        @csrf
                        @method('DELETE')
                        <div class="card__btn-trash col-1">
                            <input type="hidden" name="id" value="{{ $item->id }}" />
                            <button type="submit" class="fas fa-trash-alt btn"></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @else
    <div class="cart__empty">
        商品が入っていません。
    </div>
    @endif
</div>
@endsection