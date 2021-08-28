<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

//    public function __contruct()
//    {
//        $this->middleware('auth:admin');
//    }


    public function show()
    {
        return view('Admin/')
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