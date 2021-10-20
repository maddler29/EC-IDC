@extends('layouts.admin.login')

@section('title')
一覧
@endsection

@section('content')
    <link href="{{asset('/css/modal.css')}}" rel="stylesheet">
<div class="container">
    <div class="sell__title">
        <h3>Product List</h3>
    </div>
    @if(!empty($items))
    <div class="sell-wrapper ">
        @foreach ($items as $item)
        <div class="card mb-3 d-inline-flex">
            <div class="row">
                <div class="card-body ">
                    <div class="position-relative overflow-hidden">
                        <img src="/storage/avatars/{{$item->image}}" alt="{{ $item->name }}" class="product-cart-img" style="object-fit: cover; width: 200px; height: 200px;" />
                        @if ($item->isStateBought)
                        <div class=" position-absolute py-1 font-weight-bold d-flex justify-content-center align-items-end" style="left: 0; top: 0; color: white; background-color: #EA352C; transform: translate(-50%,-50%) rotate(-45deg); width: 125px; height: 125px; font-size: 15px;">
                            <span>SOLD OUT</span>
                        </div>
                        @endif
                        <div class="card-product-name col-md-12">
                            商品名:{{ $item->name }}
                        </div>
                        <div class="card-product-item col-md-12">
                            種類:{{ $item->item_categories->item_name }}
                        </div>
                        <div class="card-product-brand col-md-12">
                            種類:{{ $item->brand_categories->brand_name }}
                        </div>
                        <div class="card__total-price col-md-12">
                            ¥{{ number_format($item->price) }}
                        </div>
                        <div class="card__gender col-md-12">
                            @if(($item->item_categories->gender_id ) == 1)
                            Men's
                            @else
                            Wemen's
                            @endif
                        </div>
                        <div class="card__size col-md-12">
                            サイズ:{{ $item->size }}
                        </div>
                        <div class="card__material col-md-12">
                            材質:{{ $item->material }}
                        </div>
                        {{--カート画面にゴミ箱アイコンを追加--}}
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end text-nowrap ">
                            <form method="post" action="{{ route('admin.sell.destroy', $item->id) }}">
                                @csrf
                                @method('DELETE')
                                <div class="col-md-6 offset-md-2 ">
                                    <input type="hidden" name="id" value="{{ $item->id }}" />
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">削除</button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">確認</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    商品を削除しますが、よろしいですか？
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">いいえ</button>
                                                    <button type="submit" class="btn btn-danger">はい</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form method="get" action="{{ route('admin.sell.edit', $item->id) }}">
                                @csrf
                                <div class="col-md-6">
                                    <input type="hidden" name="id" value="{{ $item->id }}" />
                                    <button type="submit" class="btn btn-primary text-nowrap">編集</button>
                                </div>
                            </form>
                        </div>
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

@section('script')
    <script>
        $(function(){
        $(".open").click(function (){
        $(".modal").fadeIn();
        });
        $(".delete").click(function (){
        $(".modal").fadeOut();
        });
        $(".modal_bg").click(function (){
        $(".modal").fadeOut();
        });
        });
    </script>
@endsection
