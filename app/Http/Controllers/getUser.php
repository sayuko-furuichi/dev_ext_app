<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserProf;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;

class getUser extends Controller
{


    public function index()
    {


        return view('getUser');
    }

    //TODO:ログインが出来なかったときのエラー処理
  


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
        
        return view('dbshow', [
            'items' => $items
        ]);
    }
}
