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

    public function getCat(Request $request)
    {



        return redirect('/serve');

    }
}
