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
        $detail=([
            'events'=> [
              [
                'type'=> 'message',
                'message'=> [
                  'type'=> 'message',
                  'text'=>  '完了',
                  //line_user_idが必要
                  'text2'=>  $request->user
              ],
                'timestamp'=> $_SERVER['REQUEST_TIME'],
                'source'=> [
                  'type'=> 'web',
                  'userId'=> $request->user
                ],
                'mode'=> 'active',
                'deliveryContext'=> [
                  'isRedelivery'=> false
                ]
              ],

            ]
          ]);

        //チャネルアクセストークンを秘密鍵として、requestBodyをハッシュ化する
        #commons風アカウントのCS
        $channelSecret='df7b94e4f3a2616069aa01f3693cd8ad';

        $encode=json_encode($detail);

        $hash = hash_hmac('sha256', $encode, $channelSecret, true);
        $signature = base64_encode($hash);

        //ハッシュ化したものを[x_demo_signature]としてheaderにつける
        $header = array(
            'Content-Type: application/json',
          'x_demo_signature:'. $signature,
        );

        //試しに、create richmenuにする
        $context = stream_context_create([
            'http' => [
                'ignore_errors' => true,
                'method' => 'POST',
                'header' => implode("\r\n", $header),
                'content' => $encode
            ],
        ]);

        //Botが起動するURLへPostする
        $res=  file_get_contents('https://dev1.softnext.co.jp/commons/linebot/public/api/callback?store_id=1', false, $context);
        $msg='送信しました！';

        return redirect('/addMember');
    }
}
