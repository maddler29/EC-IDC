<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class SellController extends Controller
{
    public function createSellForm()
    {
        return view('sell.create');
    }

    public function indexSellForm()
    {
        return view('sell.index')
            ->with('products', Product::get());
    }
}
