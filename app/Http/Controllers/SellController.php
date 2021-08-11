<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SellController extends Controller
{
    // 出品画面
    public function showSellForm()
    {
        return view('product.sell');
    }
}
