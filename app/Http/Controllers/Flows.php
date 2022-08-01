<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Flows extends Controller
{
    //

    public function index(){

        return view ('flowdemo.lppage');
    }

    public function off(){

        return view ('flowdemo.official');
    }
}
