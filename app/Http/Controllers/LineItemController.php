<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\LineItem;

class LineItemController extends Controller
{
    // 4-6
    public function create(Request $request)
    {
        $cart_id = Session::get('cart');
        // createアクションでは追加した商品がすでにカートに入っているかどうかで処理を分けます。
        $line_item = LineItem::where('cart_id', $cart_id)
            ->where('product_id', $request->input('id'))
            ->first();

        // すでにカートに入れている商品を追加した場合は、元の個数に追加した個数を足して保存します。
        if ($line_item) {
            $line_item->quantity += $request->input('quantity');
            $line_item->save();
        // 追加した商品が新規の商品だった場合は、新たにline_itemsテーブルにレコードを加えます。
        } else {
            LineItem::create([
                'cart_id' => $cart_id,
                'product_id' => $request->input('id'),
                'quantity' => $request->input('quantity'),
            ]);
        }
        // カートに入れたらカート画面へ遷移
        return redirect(route('cart.index'));
    }

    public function delete(Request $request)
    {
        // Eloquentのdestroyメソッドは引数に主キーを指定して、レコードの削除をする
        LineItem::destroy($request->input('id'));
        // レコードを削除したらカート画面へリダイレクトして画面を更新
        return redirect(route('cart.index'));
    }
}
