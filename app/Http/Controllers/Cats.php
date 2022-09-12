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
        $request='';
        $param =[
            'grant_type'=>'client_credentials',
            'client_id' => '1657463796',
            'client_secret' => '4cb5a01c2509810b67a8b98e6a88efa3'

        ];
        //配列をHTTPクエリパラメータにしてくれる！
        $param=http_build_query($param,"","&");
        // $cid='1657463796';
        // $cs='4cb5a01c2509810b67a8b98e6a88efa3';

        // $cid = '&client_id='.$cid ;
        // $cs='&client_secret='.$cs;

        $header = array(
            'Content-Type: application/x-www-form-urlencoded',
        );
        $context = stream_context_create([
            'http' => [
                'ignore_errors' => true,
                'method' => 'POST',
                'header' => $header,
               'content' => $param,
            ],
        ]);
    
        $res=file_get_contents('https://api.line.me/v2/oauth/accessToken', false,$context);
        if (strpos($http_response_header[0], '200') === false) {
               $res='request failed';
        }
    
        $res=json_decode($res,true);
        //CATからLIFFアプリを追加する
        return view('serverApi.addLiff',[
            'token'=>$res['acces_token']
        ]);

        $cat = new Cat;
        $cat->cat=$res['access_token'];
        $cat->channel_id= '';
        $cat->cs='';
        
      //  return redirect('/serve')->with('token',$res->access_token);

    }
}
