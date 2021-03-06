<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mypage\Profile\EditRequest;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{

//    public function __contruct()
//    {
//        $this->middleware('auth:admin');
//    }


    public function edit()
    {
        return view('Admin/mypage.edit')
            ->with('admin', Auth::user());
    }

    public function update(EditRequest $request)
    {
        $admin = Auth::user();

        $admin->name = $request->input('name');

        if ($request->has('avatar')) {
            $fileName = $this->saveAvatar($request->file('avatar'));
            $admin->avatar_file_name = $fileName;
        }

        $admin->save();

        return redirect()->back()
            ->with('status', 'プロフィールを変更しました。');
    }

    /**
     * アバター画像をリサイズして保存します
     *
     * @param UploadedFile $file アップロードされたアバター画像
     * @return string ファイル名
     */
    private function saveAvatar(UploadedFile $file): string
    {
        $tempPath = $this->makeTempPath();

        Image::make($file)->fit(200, 200)->save($tempPath);

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
}
