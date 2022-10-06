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

            // 'destination'=> 'Uffd4dd52c580e1d2bb7b0a66e0ef1951',
            'events'=> [
              [
                'type'=> 'message',
                'message'=> [
                  'type'=> 'message',
                  'text'=>  '完了',
                  'text2'=>  $request->user
              ],
                'timestamp'=> $_SERVER['REQUEST_TIME'],
                'source'=> [
                  'type'=> 'web',
                  'userId'=> $request->user
                ],
          //              'replyToken'=> $rand_str,
                'mode'=> 'active',
           //     'webhookEventId'=> $rand_str,
                'deliveryContext'=> [
                  'isRedelivery'=> false
                ]
              ],
          
            ]
          ]);
               $header = array(
                   'Content-Type: application/json',
                 'x_demo_signature: demo',
               );
          
               //試しに、create richmenuにする
               $context = stream_context_create([
                   'http' => [
                       'ignore_errors' => true,
                       'method' => 'POST',
                       'header' => implode("\r\n", $header),
                       'content' => json_encode($detail, true)
                   ],
               ]);
              
          
           $res=  file_get_contents('https://dev-bot0722.herokuapp.com/public/api/callback?store_id=54', false, $context);
          

            //  $sss=json_decode($_POST,true);
              // dd($_POST);
              // $var_dump($res);
              //  if ($res!=[] || $res!='{}') {
          
              //   $msg='失敗しました';
              //  }else{
                $msg='送信しました！';
               


        return redirect('/addMember');
    }
}

