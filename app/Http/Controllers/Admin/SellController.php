<?php

namespace App\Http\Controllers\Admin;

use App\Models\GenderCategory;
use App\Http\Controllers\Controller;


use App\Models\Product;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class SellController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
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
                $query->whereHas('brand_categories', function ($query) use ($categoryID) {
                    //
                    $query->where('gender_id', $categoryID);
                });
            } elseif ($categoryType === 'brand') {
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
        $items = $query->get();
        // admin内のsellのindex.blade.phpへ変数を渡す
        return view('admin/sell.index')
            ->with('items', $items)
            ->with('item_categories', $item_categories)
            ->with('brand_categories', $brand_categories);
    }

    private function escape(string $value)
    {
        return str_replace(
            ['\\', '%', '_'],
            ['\\\\', '\\%', '\\_'],
            $value
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $admin = Auth::user();
        $gender_categories = GenderCategory::orderBy('sort_no')->get();
        return view('admin/sell.create')
            ->with('gender_categories', $gender_categories)
            ->with('admin', $admin);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {

        // $items = Auth::user();
        $items = new Product();
        // 画像アップロード
        $admin = Auth::user();


        if ($request->has('image')) {
            $fileName = $this->saveAvatar($request->file('image'));
            $items->image = $fileName;
        }
        // 商品名
        $items->name = $request->input('name');
        // 商品の説明
        $items->description = $request->input('description');
        // アイテムカテゴリ
        $items->item_category_id = $request->item_category;
        // ブランドカテゴリ
        $items->brand_category_id = $request->brand_category;
        // 商品の価格
        $items->price = $request->input('price');
        // 商品のサイズ
        $items->size = $request->input('size');
        // 商品の素材
        $items->material = $request->input('material');
        // 販売中
        $items->state     = Product::STATE_SELLING;
        $items->save();

        // カテゴリーidを作成し連携
        return redirect()->route('admin.sell.index')->with('items', $items)
            ->with('admin', $admin);
    }

    /**
     * アバター画像をリサイズして保存します
     *
     * @param UploadedFile $file アップロードされたアバター画像
     * @return string ファイル名
     */
    private function saveAvatar(UploadedFile $file): string
    {

        // 一時ファイルを生成してパスを取得する(makeTempPathメソッド)
        $tempPath = $this->makeTempPath();

        // Intervention Imageを使用して、画像をリサイズ後、一時ファイルに保存。
        Image::make($file)->fit(250, 250)->save($tempPath);
        // Storageファサードを使用して画像をディスクに保存しています。
        $filePath = Storage::disk('public')
            ->putFile('avatars', new File($tempPath));


        return basename($filePath);
    }

    /**
     * 一時的なファイルを生成してパスを返します。
     *
     * @return string ファイルパス
     */
    private function makeTempPath(): string
    {
        $tmp_fp = tmpfile();
        $meta   = stream_get_meta_data($tmp_fp);
        return $meta["uri"];
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
        return redirect()->route('admin.sell.index');
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
        $admin = Auth::user();

        $gender_categories = GenderCategory::orderBy('sort_no')->get();
        $items = Product::find($id);
        return view('admin/sell.edit', ['items' => $items])
            ->with('gender_categories', $gender_categories)
            ->with('admin', $admin);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {

        $admin = Auth::user();
        $items = Product::find($id);
        $items->name = $request->input('name');
        $items->description = $request->input('description');
        if ($request->has('image')) {
            $fileName = $this->saveAvatar($request->file('image'));
            $items->image = $fileName;
        }
        // アイテムカテゴリ
        $items->item_category_id = $request->item_category;
        // ブランドカテゴリ
        $items->brand_category_id = $request->brand_category;
        $items->price = $request->input('price');
        $items->size = $request->input('size');
        $items->material = $request->input('material');
        $items->save();

        // カテゴリーidを作成し連携
        return redirect()->route('admin.sell.index')
            ->with('status', '商品を変更しました。')
            ->with('admin', $admin);
    }
}
