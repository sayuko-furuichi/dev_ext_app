<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Logins extends Controller
{
    //

    public function index()
    {
        $url="https://access.line.me/oauth2/v2.1/authorize?";
        $canneld = "";


        return views('login');

    }






}
