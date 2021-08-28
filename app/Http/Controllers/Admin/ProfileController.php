<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mypage\Profile\EditRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $user = Auth::user();

        $user->name = $request->input('name');
        $user->save();

        return redirect()->back()
            ->with('status', 'プロフィールを変更しました。');
    }
}
