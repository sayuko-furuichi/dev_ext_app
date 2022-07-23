<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserProf;
use Illuminate\Support\Facades\DB;

class getUser extends Controller
{
    public function index()
    {
    $authUrl = "https://access.line.me/oauth2/v2.1/authorize?response_type=code&";

        $cbUrl="https://dev-ext-app.herokuapp.com/public/user";
        
        $encUrl= urlencode($cbUrl);
        $authUrl .= ("redirect_uri=" . $encUrl);
        //文字列生成
        $state =  substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz'), 0, 8);
        $authUrl .= ("&stale=" . $state);
        $scope ="profile";
        $authUrl .= ("&scope=" . $scope);



        return redirect ($authUrl);
    }


    public function getUser(Request $request)
    {
        $lu = new UserProf;
        if (isset($request->id)) {
            $lu ->line_user_id = $request->id;
        } else {
            $lu ->line_user_id = "";
        }
        
        if (isset($request->nm)) {
            $lu ->line_user_name = $request->nm;
        } else {
            $lu ->line_user_name = "";
        }
        
        if (isset($request->msg)) {
            $lu ->prof_msg =  $request->msg;
        } else {
            $lu ->prof_msg = "";
        }

        if (isset($request->os)) {
            $lu ->user_os = $request->os;
        } else {
            $lu ->user_os  = "";
        }

        if (isset($request->msg)) {
            $lu ->user_trans = $request->con;
        } else {
            $lu ->user_trans= "";
        }

        if (isset($request->url)) {
            $lu ->prof_img_url =  $request->url;
        } else {
            $lu ->prof_img_url = "";
        }

       



        $lu->save();

        // $lu -> save();
        echo "$lu";

        return redirect('/user');
    }


    //DBのデータ閲覧

    public function dbshow()
    {
        $items = DB::table('user_profs')
        -> select('*')
        ->orderBy('created_at', 'DESC')
        ->limit(10)
        ->get();
        
        return view ('dbshow',[
            'items' => $items
        ]);
    }



}
