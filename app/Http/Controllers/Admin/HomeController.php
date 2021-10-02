<?php

namespace App\Http\Controllers\Admin;

use App\Models\GenderCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ItemCategory;
use App\Models\BrandCategory;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $admin = Auth::user();
        $item_categories = GenderCategory::query()
            ->with([
                'item_categories' => function ($query) {
                    $query->orderBy('sort_no');
                }
            ])
            ->orderBy('sort_no')
            ->get();

        $brand_categories = GenderCategory::query()
            ->with([
                'brand_categories' => function ($query) {
                    $query->orderBy('sort_no');
                }
            ])
            ->orderBy('sort_no')
            ->get();

        //            $defaults = [
        //                Request::input('category', ''),
        //                Request::input('keyword', ''),
        //            ];

        return view('admin.home')
            ->with('admin', $admin)
            ->with('item_categories', $item_categories)
            ->with('brand_categories', $brand_categories);
        //        ->with('defaults', $defaults);
    }
}
