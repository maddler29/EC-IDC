<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProductController extends Controller
{
    public function index()
    {

        $user = Auth::user();
        $items = Product::orderByRaw("FIELD(state, '" . Product::STATE_SELLING . "', '" . Product::STATE_BOUGHT . "')")
            ->orderBy('id', 'DESC')
            ->paginate(9);

        return view('user.product.index')
            // withメソッドではBladeテンプレートに値を渡すことができます。
            // Eloquentのgetメソッドを用いてproductsテーブルの全データ取得し、
            // productsという変数名でBladeテンプレートに渡しています。
            ->with('products', $items)
            ->with('user', $user);
    }

    public function show($id)
    {
        $user = Auth::user();
        $product = Product::find($id);
        return view('user.product.show')
            ->with('product', $product)
            ->with('user', $user);
    }
}
