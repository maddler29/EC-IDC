<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    public function index()
    {
        return view('product.index')
            // withメソッドではBladeテンプレートに値を渡すことができます。
            // Eloquentのgetメソッドを用いてproductsテーブルの全データ取得し、
            // productsという変数名でBladeテンプレートに渡しています。
            ->with('products', Product::get());

        }

    public function show($id)
    {
        return view('product.show')
            ->with('product', Product::find($id));
    }
}
