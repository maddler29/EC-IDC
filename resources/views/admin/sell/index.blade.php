@extends('layouts.admin.login')

@section('title')
一覧
@endsection

@section('content')
<div class="container">
    <div class="sell__title">
        <h3>Product List</h3>
    </div>
    @if(!empty($items))
    <div class="sell-wrapper">
        @foreach ($items as $item)
        <div class="card mb-3">
            <div class="row">
                <img src="/storage/avatars/{{$item->image}}" alt="{{ $item->name }}" class="product-cart-img" style="object-fit: cover; width: 300px; height: 400px;" />
                <div class="card-body">
                    <div class="card-product-name col-md-6">
                        商品名:{{ $item->name }}
                    </div>
                    <div class="card-product-name col-6">
                        {{--アイテムカテゴリ表示 多対多のテーブル関係を作成する必要がありそう--}}
                        {{--種類:{{ $item->item_categories->item_name }}--}}
                    </div>
                    <div class="card__total-price col-md-6">
                        ¥{{ number_format($item->price) }}
                    </div>
                    <div class="card__size col-md-6">
                        サイズ:{{ $item->size }}
                    </div>
                    <div class="card__material col-md-6">
                        材質:{{ $item->material }}
                    </div>
                    {{--カート画面にゴミ箱アイコンを追加--}}
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end ">
                        <form method="post" action="{{ route('admin.sell.destroy', $item->id) }}">
                            @csrf
                            @method('DELETE')
                            <div class="col-md-6 offset-md-2 ">
                                <input type="hidden" name="id" value="{{ $item->id }}" />
                                <button type="submit" class="fas fa-trash-alt btn btn-light"></button>
                            </div>
                        </form>
                        <form method="get" action="{{ route('admin.sell.edit', $item->id) }}">
                            @csrf
                            <div class="col-md-6">
                                <input type="hidden" name="id" value="{{ $item->id }}" />
                                <button type="submit" class="btn btn-primary ">編集</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @else
    <div class=" cart__empty">
        商品が入っていません。
    </div>
    @endif
</div>
@endsection
