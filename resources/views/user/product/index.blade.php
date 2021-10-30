@extends('layouts.user.login')

@section('title')
商品一覧
@endsection

@section('content')
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block mx-auto" src="{{ asset('/images/slide/IMG_8858.jpg') }}" alt="First slide">
        </div>
        <div class="carousel-item">
            <img class="d-block mx-auto" src="{{ asset('/images/slide/IMG_8859.jpg') }}" alt="Second slide">
        </div>
        <div class="carousel-item">
            <img class="d-block mx-auto" src="{{ asset('/images/slide/IMG_8860.jpg') }}" alt="Third slide">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<div class="row">
    <div class="col-8 offset-2">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif
    </div>
</div>


<div class="container">
    <div class="top__title text-center">
        <h2>All Products</h2>
    </div>
    <div class="row">
        @foreach( $items as $item )
        <div class="col-3 mb-3">
            <a href="{{ route('user.product.show', $item->id) }}" class="bg-secondary  d-inline-block d-flex justify-content-center  flex-column" role="button" style="border-radius: 75px;">
                <div class="card ">
                    <div class="position-relative overflow-hidden">
                        <img src=" /storage/avatars/{{$item->image}}" class="card-image">
                        <div class="position-absolute py-2 px-3" style="left: 0; bottom: 10px; color: white; background-color: rgba(0, 0, 0, 0.70)">
                            <i class="fas fa-yen-sign"></i>
                            <span class="ml-1">{{number_format($item->price)}}</span>
                        </div>

                        @if ($item->isStateBought)
                        <div class=" position-absolute py-1 font-weight-bold d-flex justify-content-center align-items-end" style="left: 0; top: 0; color: white; background-color: #EA352C; transform: translate(-50%,-50%) rotate(-45deg); width: 125px; height: 125px; font-size: 15px;">
                            <span>SOLD OUT</span>
                        </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <h5>{{ $item->name }}</h5>
                        <p class="text-muted">サイズ : 性別 {{ $item->size }} /
                            @if(($item->item_categories->gender_id ) == 1)
                            Men's
                            @else
                            Wemen's
                            @endif
                        </p>
                        <p class="text-muted">ブランド : アイテム </br>
                            {{ $item->brand_categories->brand_name }} /
                            {{$item->item_categories->item_name }}
                        </p>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center">
        {{ $items->links() }}
    </div>
</div>
@endsection
