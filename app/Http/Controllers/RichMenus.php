<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RichMenus extends Controller
{
    //
    public function index(){

        return view('sendEvents.richMenuMng');
    }

    public function viewList(){

        return redirect('/rich');
    }
}
