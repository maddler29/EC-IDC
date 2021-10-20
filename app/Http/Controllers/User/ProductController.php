<?php

namespace App\Http\Controllers\User;

use App\Models\GenderCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        // $brand_categoriesという変数の中に、GenderCategoryというモデルからデータを取得する
        $brand_categories = GenderCategory::query()
            // brand_categoriesというリレーションのテーブルのデータも一緒に取得する
            ->with([
                'brand_categories' => function ($query) {
                    // データの並び順は、sotr_noの降順にして取得する
                    $query->orderBy('sort_no');
                }
            ])
            // GenderCategoryの並び順もsort_noの降順にして取得する
            ->orderBy('sort_no')
            // 実際に取得する
            ->get();
        // $item_categoriesという変数の中に、GenderCategoryというモデルからデータを取得する
        $item_categories = GenderCategory::query()
            // item_categoriesというリレーションのテーブルのデータも一緒に取得する
            ->with([
                'item_categories' => function ($query) {
                    // データの並び順は、sotr_noの降順にして取得する
                    $query->orderBy('sort_no');
                }
            ])
            // GenderCategoryの並び順もsort_noの降順にして取得する
            ->orderBy('sort_no')
            // 実際に取得する
            ->get();

        // $queryという変数の中に、Productというモデルからデータを取得する
        $query = Product::query();

        // カテゴリで絞り込み
        // キー(brand_category)がリクエストに存在しており、かつ値が入力されていたら
        if ($request->filled('brand_category')) {
            // カテゴリから種別とIDに切り分ける(explode)　第一引数には、コロン。第二引数には、brand_categoryを表す文字列を渡している
            list($categoryType, $categoryID) = explode(':', $request->input('brand_category'));
            // もし、種別($categoryType)とgenderが完全一致ならば
            if ($categoryType === 'gender') {
                //第一引数にProductモデルのリレーション(brand_categories)先のテーブルのカラムの
                $query->whereHas('brand_categories', function ($query) use ($categoryID) {
                    //
                    $query->where('gender_id', $categoryID);
                });            } elseif ($categoryType === 'brand') {
                $query->where('brand_category_id', $categoryID);
            }
        }
        // キー(item_category)がリクエストに存在しており、かつ値が入力されていたら
        if ($request->filled('item_category')) {
            // カテゴリから種別とIDに切り分ける(explode)　第一引数には、コロン。第二引数には、item_categoryを表す文字列を渡している
            list($categoryType, $categoryID) = explode(':', $request->input('item_category'));
            // もし、種別($categoryType)とgenderが完全一致なら
            if ($categoryType === 'gender') {
                //第一引数にProductモデルのリレーション(item_categories)先のテーブルのカラムの
                $query->whereHas('item_categories', function ($query) use ($categoryID) {
                    //$categoryID(gender_id)を絞り込みする
                    $query->where('gender_id', $categoryID);
                });
                // もし、種別($categoryType)がitemと完全一致なら
            } elseif ($categoryType === 'item') {
                // $categoryID(item_category_id)を絞り込みする
                $query->where('item_category_id', $categoryID);
            }
        }
        // キーワードで絞り込み
        // もし、キー(keyword)がリクエストに存在しており、かつ値が入力されていたら
        if ($request->filled('keyword')) {
            // keywordを部分一致で検索する
            $keyword = '%' . $this->escape($request->input('keyword')) . '%';
            $query->where(function ($query) use ($keyword) {
                // 名前にキーワードが含まれる(任意の文字列に一致します(0文字も含む)or任意の1文字に一致します)
                $query->where('name', 'LIKE', $keyword);
                // 説明文にキーワードが含まれる(任意の文字列に一致します(0文字も含む)or任意の1文字に一致します)
                $query->orWhere('description', 'LIKE', $keyword);
            });
        }
        // $itemsという変数の中に$queryという変数を取得
        $items = $query->paginate(9);

        // admin内のsellのindex.blade.phpへ変数を渡す
        return view('user.product.index')
            ->with('items', $items)
            ->with('item_categories', $item_categories)
            ->with('brand_categories', $brand_categories)
            ->with('user', $user);
    }

    private function escape(string $value)
    {
        return str_replace(
            ['\\', '%', '_'],
            ['\\\\', '\\%', '\\_'],
            $value
        );
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
