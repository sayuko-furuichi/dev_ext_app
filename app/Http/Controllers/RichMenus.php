<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RichMenus extends Controller
{
    //
    public function index(){

        $detail=([

            'destination'=> 'Uffd4dd52c580e1d2bb7b0a66e0ef1951',
            'events'=> [
              [
                'type'=> 'message',
                'message'=> [
                  'type'=> 'text',
                  'text'=>  'plz RichMenus',
             //     'text2'=>  $request->msg2
              ],
                'timestamp'=> $_SERVER['REQUEST_TIME'],
                'source'=> [
                  'type'=> 'web',
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
        
    
         file_get_contents('https://dev-bot0722.herokuapp.com/public/api/callback?store_id=3', false, $context);
    
         if (strpos($http_response_header[0], '200') === false) {
            //  $rmList = 'false';
         }
       //  $rmList=json_decode($rmList,true);
        

        return view('sendEvents.richMenuMng'
        );
    }

    public function viewList(Request $request){

        $request=json_decode($request,true);
        $sss=json_decode($_POST,true);
        $var_dump($sss);
        $var_dump($request);

        return view('sendEvents.richMenuMng',[
            'rmList'=>$sss
        ]);
    }
}