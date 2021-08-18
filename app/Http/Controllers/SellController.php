<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class SellController extends Controller
{
    public function indexSellForm()
    {
        return view('sell.index')
            ->with('products', Product::get());
    }

    public function createSellForm()
    {
        return view('sell.create');
    }

    public function storeSellForm(Request $request)
    {
        $items = new Product();
        $items->name = $request->input('name');
        $items->description = $request->input('description');
        $items->image = $request->input('image');
        $items->price = $request->input('price');
        $items->save();
        // $items->size = $request->input('size');
        // カテゴリーidを作成し連携
        return redirect()->route('sell.index');
    }
}
