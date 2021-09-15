@extends('layouts.admin.app')

@section('title')
商品更新
@endsection

@section('content')
<div class="container">

    <div class="row">
        <div class="col-8 offset-2 bg-white">

            <div class="font-weight-bold text-center border-bottom pb-3 pt-3" style="font-size: 24px">商品更新</div>

            <form method="POST" action="{{ route('admin.sell.update',$items->id ) }}" class="p-5" enctype="multipart/form-data">
                @method('PATCH')
                @include('admin.sell.form')
                <div class="form-group mb-0 mt-3">
                    <button type="submit" class="btn btn-block btn-primary">
                        更新する
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    document.querySelector('.image-picker input')
        .addEventListener('change', (e) => {
            const input = e.target;
            const reader = new FileReader();
            reader.onload = (e) => {
                input.closest('.image-picker').querySelector('img').src = e.target.result
            };
            reader.readAsDataURL(input.files[0]);
        });
</script>
@endsection