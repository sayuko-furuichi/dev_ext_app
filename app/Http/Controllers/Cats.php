<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cat;

class Cats extends Controller
{
    //
    public function index()
    {
        return view('serverApi.addLiff');
    }

    public function send(Request $request)
    {
        //lineログインチャネルのCATを取得する
        //CSと、チャネルIDが必要


        //CATからLIFFアプリを追加する


        return redirect('/serve')->with('flash_message','送信しました');

    }
}
