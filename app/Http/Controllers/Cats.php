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
        $param=http_build_query($param, "", "&");

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

        $res=file_get_contents('https://api.line.me/v2/oauth/accessToken', false, $context);
        if (strpos($http_response_header[0], '200') === false) {
            $res='request failed';
        }
  //      dd($res);
        $resj=json_decode($res, true);
        //CATからLIFFアプリを追加する


        $cat = new Cat;
        $cat->cat=$resj['access_token'];
        $cat->channel_id= '1657463796';
        $cat->liff_cs='4cb5a01c2509810b67a8b98e6a88efa3';
        
        return view('serverApi.addLiff', [
            'token'=>$resj['access_token']
        ]);
        $res=$this->addLiff();

        //  return redirect('/serve')->with('token',$res->access_token);
    }

    public function addLiff()
    {
        $param =[
            'grant_type'=>'client_credentials',
            'client_id' => '1657463796',
            'client_secret' => '4cb5a01c2509810b67a8b98e6a88efa3'

        ];
        $header = array(
            'Content-Type: application/x-www-form-urlencoded',
        );
        $context = stream_context_create([
            'http' => [
                'ignore_errors' => true,
                'method' => 'POST',
                'header' => $header,
               'content' => json_encode($param)
            ],
        ]);

        $res=file_get_contents('https://api.line.me/liff/v1/apps', false, $context);
        if (strpos($http_response_header[0], '200') === false) {
            $res='request failed';
            return $res;
        }
    }
}
