<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SellController extends Controller
{
    public function createSellForm()
    {
        return view('sell.create');
    }
}
