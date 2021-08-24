<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        return view('user.product.index')
            // withメソッドではBladeテンプレートに値を渡すことができます。
            // Eloquentのgetメソッドを用いてproductsテーブルの全データ取得し、
            // productsという変数名でBladeテンプレートに渡しています。
            ->with('products', Product::get());
    }

    public function show($id)
    {
        return view('user.product.show')
            ->with('product', Product::find($id));
    }
}
