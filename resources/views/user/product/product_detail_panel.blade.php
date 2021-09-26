<div class="font-weight-bold text-center pb-3 pt-3" style="font-size: 24px">{{$product->name}}</div>

<div class="row">
  <div class="col-4 offset-1">
    <img class="card-img-top" src=" /storage/avatars/{{$product->image}}">
  </div>
  <div class="col-6">
    <table class="table table-bordered">
      <tr>
        <th>出品者</th>
        <td>
          @if (!empty($user->avatar_file_name))
          <img src="/storage/avatars/{{$user->avatar_file_name}}" class="rounded-circle" style="object-fit: cover; width: 35px; height: 35px;">
          @else
          <img src="/images/avatar-default.svg" class="rounded-circle" style="object-fit: cover; width: 35px; height: 35px;">
          @endif

        </td>
      </tr>
      <tr>
        <th>カテゴリー</th>
        <td>{{$product->item_categories->item_name}} / {{$product->brand_categories->brand_name}}</td>
      </tr>
      <tr>
        <th>サイズ</th>
        <td>{{$product->size}}</td>
      </tr>
    </table>
  </div>
</div>

<div class="font-weight-bold text-center pb-3 pt-3" style="font-size: 24px">
  <i class="fas fa-yen-sign"></i>
  <span class="ml-1">{{number_format($product->price)}}</span>
</div>