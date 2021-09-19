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

        Inquiry::create($request);
        return back()->with('message', 'メールを送信したのでご確認ください');
    }
}
