<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoginUser;

class Login extends Controller
{
    //
    private $state;
    private $code;
    private $encUrl;

    public function login()
    {
        //認可URL生成
        $authUrl = "https://access.line.me/oauth2/v2.1/authorize?response_type=code&";

        $cbUrl="https://dev-ext-app.herokuapp.com/public/callback";
    
        $this->encUrl= urlencode($cbUrl);
        $authUrl .= ("redirect_uri=" . $this->encUrl);
        //文字列生成
        $this->state =  substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz'), 0, 8);
        //  $authUrl .= ("&state=" . $this->state);
        
        //scope profileにしてるよ！
        $scope ="profile";
        $authUrl .= ("&scope=" . $scope);

        //chanell ID
        $chaId="1657292332";
        $authUrl .= ("&client_id=" .  $chaId);


        return redirect($authUrl .= ("&state=" . $this->state));
    }


    public function callback(Request $request){
        $this->code= $request->code;

        $api_url ='https://api.line.me/oauth2/v2.1/token';

        //エンコードされたURLで通信する
        $headers = [ "Content-Type:application/x-www-form-urlencoded",];

        $curl_handle = curl_init();

        curl_setopt($curl_handle, CURLOPT_POST, true);
        curl_setopt($curl_handle, CURLOPT_URL, $api_url);
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS, "grant_type=authorization_code&code=$this->code&redirect_uri=https://dev-ext-app.herokuapp.com/public/callback&client_id=1657292332&client_secret=1b8433d37832199bf746a66e7d8a5a77" );
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
                // curl_exec()の結果を文字列にする
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
        

        //実行
        $json_response = curl_exec($curl_handle);

        //close
        curl_close($curl_handle);

        //デコード
        $decoded_data = json_decode($json_response, true);

        //アクセス

        //DBに格納
        $logUser =new LoginUser;
        $loguser->access_token = $decoded_data['access_token'];
        $loguser->refresh_token = $decoded_data['refresh_token'];
        $loguser->scope = $decoded_data['scope'];
        $loguser->line_user_id = "";

        $logUser ->save();





        return view('getUser');
    }




}
