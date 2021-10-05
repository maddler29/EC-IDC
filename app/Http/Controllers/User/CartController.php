<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Cart;
use App\Models\LineItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // Session::get('cart')でセッションからカートIDを取得し、$cart_id変数へ代入しています。
        $cart_id = Session::get('cart');
        $cart = Cart::find($cart_id);

        // $total_price変数に商品の価格 * 商品の個数を足し合わせることで、合計金額を算出
        $total_price = 0;
        foreach ($cart->products as $product) {
            $total_price += $product->price * $product->pivot->quantity;
        }

        // withメソッドでは、複数の値をBladeテンプレートへ渡す
        return view('user.cart.index')
            ->with('line_items', $cart->products)
            ->with('total_price', $total_price)
            ->with('user', $user);
    }

    // 5-5
    public function checkout()
    {
        $cart_id = Session::get('cart');
        $cart = Cart::find($cart_id);
        //購入した商品にSTATE_SELLINGからSTATE_BOUGHTに変更したい
        // $products = Product::find($cart_id); ←$cart_idだと関係ない商品がSTATE_BOUGHTになる

        // $products->state = Product::STATE_BOUGHT;
        // $products->save();

        // 5-8
        if (count($cart->products) <= 0) {
            return redirect(route('user.cart.index'));
        }

        $line_items = [];
        foreach ($cart->products as $product) {
            $line_item = [
                'name'        => $product->name,
                'description' => $product->description,
                'amount'      => $product->price,
                'currency'    => 'jpy',
                'quantity'    => $product->pivot->quantity,
            ];
            array_push($line_items, $line_item);
        }

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items'           => [$line_items],
            'success_url'          => route('user.cart.success'),
            'cancel_url'           => route('user.cart.index'),
        ]);

        return view('user.cart.checkout', [
            'session' => $session,
            'publicKey' => env('STRIPE_PUBLIC_KEY'),
        ]);
    }

    // 5-7
    public function success()
    {
        $cart_id = Session::get('cart');
        $products = LineItem::where('cart_id', '=', $cart_id)->get(
            ['product_id']
        )->toArray();
        foreach ($products as $product) {
            $item = Product::find($product['product_id']);
            $item->state = Product::STATE_BOUGHT;
            $item->save();
        };
        LineItem::where('cart_id', $cart_id)->delete();

        return redirect(route('user.product.index'))
            ->with('products', $item)
            ->with('status', '決済処理完了しました。');
    }
}
