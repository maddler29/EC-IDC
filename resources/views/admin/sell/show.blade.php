@extends('layouts.admin.app')

@section('title')
{{ $items->name }}
@endsection

@section('content')
<div class="container">
  <div class="sell">
    <img src="{{ asset($items->image) }}" class="sell-img" />
    <div class="sell__content-header text-center">
      <div class="sell__name">
        {{ $items->name }}
      </div>
      <div class="sell__price">
        ¥{{ number_format($items->price) }}
      </div>
    </div>
    {{ $items->description }}
    {{--deleteメソッド deleterouteの追加--}}
    <form method="DELETE" action="{{ route('admin.product.delete',$id) }}">

      <div class="sell__btn-add-cart">
        <button type="submit" class="btn btn-outline-secondary">削除</button>
      </div>
    </form>
  </div>
</div>
@endsection
