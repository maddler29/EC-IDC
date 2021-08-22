<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class AdminSellController extends Controller
{
    public function indexAdminSellForm()
    {
        return view('admin/sell.index')
            ->with('products', Product::get());
    }

    public function createAdminSellForm()
    {
        return view('admin/sell.create');
    }

    public function storeAdminSellForm(Request $request)
    {
        $items = new Product();
        $items->name = $request->input('name');
        $items->description = $request->input('description');
        $items->image = $request->input('image');
        $items->price = $request->input('price');
        $items->save();
        // $items->size = $request->input('size');
        // カテゴリーidを作成し連携
        return redirect()->route('admin/sell.index');
    }

    public function updateAdminSellForm(Request $request, $id)
    {
        $items = Product::find($id);
        $items->name = $request->input('name');
        $items->description = $request->input('description');
        $items->image = $request->input('image');
        $items->price = $request->input('price');
        $items->save();
        // $items->size = $request->input('size');
        // カテゴリーidを作成し連携
        return redirect()->route('admin/sell.index');
    }
}
