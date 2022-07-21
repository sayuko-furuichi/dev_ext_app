<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LineUser;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        return view('entrance');
    }
    public function getUser(Request $request)
    {
        //DBからuserIDを取得し、登録済みなら更新にする
        $liused =LineUser::where('line_userid', $request->_token)->first();
      
        if (isset($liused)) {
            $liused -> liff_access_token = $request -> _token;
            $liused->save();
        } else {
            $lineUser = new LineUser;
            $lineUser->liff_access_token = $request -> _token;
            $lineUser->line_userid = $request -> _token;
            $lineUser->save();
        }

        $url = 'https://api.line.me/v2/oauth/accessToken';
        $data = array(
      "grant_type" => "client_credentials",
      "client_id" => "1657185923", //LINEミニアプリのクライアントID
      "client_secret" => "f86e25cbed76a9bdc270e44529ad402c", //LINEミニアプリのclient_secret
  );
        $data = http_build_query($data, "", "&");
        $header = array(
      "Content-Type: application/x-www-form-urlencoded",
      "Content-Length: ".strlen($data)
  );
        $context = array(
      "http" => array(
          "method"  => "POST",
          "header"  => implode("\r\n", $header),
          "content" => $data
      )
  );
        $json = file_get_contents($url, false, stream_context_create($context));
        $arr = json_decode($json, true);
        $access_token = $arr['access_token'];
        echo $access_token ;
  
        //userのアクセストークンを取得
        $liff_access_token = "";
        if (isset($_GET['access_token'])) {
            $liff_access_token = $_GET['access_token'];
        }
        echo $liff_access_token;
        /*
            //サービス通知トークンを取得
            //LINEのAPIにアクセスして、固有なサービス通知トークンを取ってきます
            $data = array(
            "liffAccessToken" => $liff_access_token,
          );
            $data = json_encode($data);
            $header = array(
            "Content-Type: application/json; charset=UTF-8",
            'Authorization: Bearer '. $access_token,
            );
            $options = array(
            "http" => array(
              "method" => "POST",
              "header"  => implode("\r\n", $header),
              "content" => $data
            )
          );
            $context = stream_context_create($options);
            $json = file_get_contents("https://api.line.me/message/v3/notifier/token", false, $context);
            $arr = json_decode($json, true);
            $notificationToken = $arr['notificationToken'];
            echo $notificationToken;

            //サービスメッセージ送信
            $data = array(
            "templateName" => "order_comp_d_o_ja", //コンソールで設定したテンプレートに従う
            "notificationToken" => $notificationToken,
          );
            $data = json_encode($data);
            echo   $data;
            $header = array(
            "Content-Type: application/json; charset=UTF-8",
            'Authorization: Bearer '. $access_token,
            );
            $options = array(
            "http" => array(
              "method" => "POST",
              "header"  => implode("\r\n", $header),
              "content" => $data
            )
          );
            $context = stream_context_create($options);
            $json = file_get_contents("https://api.line.me/message/v3/notifier/send?target=service", false, $context);  //
*/
        return view('entrance');
    }
}
