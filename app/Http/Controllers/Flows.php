<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Flows extends Controller
{
    //

    public function index()
    {
        return view('flowdemo.lppage');
    }

    public function off()
    {
        return view('flowdemo.official');
    }

    public function member()
    {
        return view('flowdemo.members');
    }

    public function add(Request $request)
    {
        return view('flowdemo.members', ['req'=>$request]);
    }

    public function rgst(Request $request)
    {
        return redirect('/addMember');
    }
}

