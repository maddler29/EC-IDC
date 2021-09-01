<?php

namespace App\Http\Controllers\Admin;

use App\Models\GenderCategory;
use App\Http\Controllers\Controller;

use App\Models\Product;
use Illuminate\Http\Request;

class SellController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin/sell.index')
            ->with('products', Product::get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gender_categories = GenderCategory::orderBy('sort_no')->get();
        return view('admin/sell.create')
            ->with('gender_categories', $gender_categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Product::find($id);
        return view('admin/sell.show', ['item' => $item]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Product::find($id);
        return view('admin/sell.edit', ['item' => $item]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Product::find($id);
        $item->delete();
        return redirect()->route('admin/sell.index');
    }
}
