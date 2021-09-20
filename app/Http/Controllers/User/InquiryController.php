<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\Inquiry;
use App\Http\Requests\InquiryRequest;
use App\Http\Controllers\Controller;

class InquiryController extends Controller
{
    public function create()
    {
        return view('user.inquiry.create');
    }

    public function store(InquiryRequest $request)
    {
        $inputs = new Inquiry();
        $inputs->title = $request->input('title');
        $inputs->body = $request->input('body');
        $inputs->email = $request->input('email');
        $inputs->save();

        return back()->with('message', 'メールを送信したのでご確認ください');
    }
}
