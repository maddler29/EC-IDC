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
    public function index()
    {
        $items = Product::with('item_categories', 'brand_categories')
            ->get();


        $item_categories = GenderCategory::query()
            ->with([
                'item_categories' => function ($query) {
                    $query->orderBy('sort_no');
                }
            ])
            ->orderBy('sort_no')
            ->get();
        //        dd($item_categories);

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
        //        dd($brand_categories);

        return view('admin/sell.index')
            ->with('items', $items)
            ->with('item_categories', $item_categories)
            ->with('brand_categories', $brand_categories);
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
    public function store(ProductRequest $request)
    {

        // $items = Auth::user();
        $items = new Product();
        // 画像アップロード

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
        $items->save();

        // カテゴリーidを作成し連携
        return redirect()->route('admin.sell.index')->with('items', $items);
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
        $gender_categories = GenderCategory::orderBy('sort_no')->get();
        $items = Product::find($id);
        return view('admin/sell.edit', ['items' => $items])
            ->with('gender_categories', $gender_categories);
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
            ->with('status', '商品を変更しました。');
    }
}
