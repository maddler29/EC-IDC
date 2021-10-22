@csrf
{{-- 商品画像 --}}
<div>商品画像</div>
<span class="item-image-form image-picker">

    <input type="file" name="image" class="d-none" accept="image/png,image/jpeg,image/gif" id="image" />

    <label for="image" class="d-inline-block" role="button">
        {{-- @if (!empty($items->image))--}}
        {{-- <img src="/storage/products/{{$items->image ?? ''}}" style="object-fit: cover; width: 300px; height: 300px;">--}}
        {{-- @else--}}
        {{-- <img src="/images/item-image-default.png" style="object-fit: cover; width: 300px; height: 300px;">--}}
        {{-- @endif--}}

        @if (!empty($items->image))
        <img src="/storage/avatars/{{$items->image}}" style="object-fit: cover; width: 250px; height: 250px;">
        @else
        <img src="/images/item-image-default.png" style="object-fit: cover; width: 250px; height: 250px;">
        @endif
    </label>
</span>
@error('item-image')
<div style="color: #E4342E;" role="alert">
    <strong>{{ $message }}</strong>
</div>
@enderror

{{-- 商品名 --}}
<div class="form-group mt-3">
    <label for="name">商品名</label>
    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $items->name ?? old('name') }}" required autocomplete="name" autofocus>
    @error('name')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

{{-- 商品の説明 --}}
<div class="form-group mt-3">
    <label for="description">商品の説明</label>
    <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" required autocomplete="description" autofocus>{{ $items->description ?? old('description') }}</textarea>
    @error('description')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

{{-- アイテムカテゴリ --}}
<div class="form-group mt-3">
    <label for="category">アイテムカテゴリ</label>
    <select name="item_category" class="custom-select form-control @error('item_category') is-invalid @enderror">
        @foreach ($gender_categories as $gender_category)
        <optgroup label="{{$gender_category->gender}}">
            @foreach ($gender_category->item_categories as $item_category)
            <option value="{{$item_category->id}}" {{old('item_category') == $item_category->id ? 'selected': ''}}>
                {{$item_category->item_name}}
            </option>
            @endforeach
        </optgroup>
        @endforeach
    </select>
    @error('item_category')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
{{-- ブランドカテゴリ --}}
<div class="form-group mt-3">
    <label for="category">ブランドカテゴリ</label>
    <select name="brand_category" class="custom-select form-control @error('brand_category') is-invalid @enderror">
        @foreach ($gender_categories as $gender_category)
        <optgroup label="{{$gender_category->gender}}">
            @foreach ($gender_category->brand_categories as $brand_category)
            <option value="{{$brand_category->id}}" {{old('brand_category') == $brand_category->id ? 'selected': ''}}>
                {{$brand_category->brand_name}}
            </option>
            @endforeach
        </optgroup>
        @endforeach
    </select>
    @error('brand_category')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
{{-- 素材 --}}
<div class="form-group mt-3">
    <label for="material">素材</label>
    <input id="material" name="material" type="text" class="form-control @error('material') is-invalid @enderror" value="{{ $items->material ?? old('material')}}" required autocomplete="material" pattern="A-Za-z]">
    </input>
    @error('material')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

{{-- 商品のサイズ --}}
<div class="form-group mt-3">
    <label for="size">サイズ</label>
    <input id="size" name="size" type="text" class="form-control @error('size') is-invalid @enderror" value="{{ $items->size ?? old('size')}}" required autocomplete="size" pattern="^[0-9A-Za-z]+$">
    </input>
    @error('size')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

{{-- 販売価格 --}}
<div class="form-group mt-3">
    <label for="price">販売価格</label>
    <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ $items->price ?? old('price')}}" required autocomplete="price" autofocus>
    @error('price')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>