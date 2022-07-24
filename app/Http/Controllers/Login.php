<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoginUser;
use App\Models\UserProf;
use Illuminate\Support\Facades\DB;

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
      //  dd($decoded_data['access_token']);

      //エラーが解決しないので急しのぎだが
       $access_token="eyJhbGciOiJIUzI1NiJ9.8UfdPW_1j1pNobRJMei71J_7SwIv2GYqOUzKxYm5v9pgCIrIaCS81LHoPoy62iaRsAJHNrDFK-OfTSnR-YVn_z_KJNey1VGtVgec_2ZOTjrNyq-D-oHhk2TTpNmLTru-I65nzwXXnM-Anuekh6wV7Haa0NpmYUMwLfS_yt7YwN0.fYUbi8GRoLpSNG9nIFst3iKJHb_CLBbu9CW_VNphR74";
   
       /*
      //DBに格納
        $logUser =new LoginUser;
        $loguser->access_token =$decoded_data['access_token'];
        $loguser->refresh_token =$decoded_data['refresh_token'];
        $loguser->scope =$decoded_data['scope'];
        $loguser->line_user_id = "";
        $loguser->expires_in =$decoded_data['expires_in'];
       

        $logUser ->save();
         */

        $this->getProf($access_token);
  


        return view('getUser');
    }

/**
 *  function getProfile
 *
 * @param [type] $access_token
 * @return UserProf
 */
    public function getProf($access_token){

        $api_url ='https://api.line.me/v2/profile';

        //GETでリクエストする。
        $headers = [ "Authorization:Bearer $access_token",];

        $curl_handle = curl_init();

        curl_setopt($curl_handle, CURLOPT_HTTPGET, true);
        curl_setopt($curl_handle, CURLOPT_URL, $api_url);
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
                // curl_exec()の結果を文字列にする
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
        

        //実行
        $json_response = curl_exec($curl_handle);

        //close
        curl_close($curl_handle);

        //デコード
        $decoded_data = json_decode($json_response, true);
       
       $up = new UserProf;
       $up->line_user_id=$decoded_data['userId'];
       $up->line_user_name=$decoded_data['displayName'];
       $up->prof_img_url=$decoded_data['pictureUrl'];
       $up->prof_msg=$decoded_data['statusMessage'];
    
       //取得不可なので空文字でinsert
       $up->user_os="";
     $up->user_trans="";
       $up->save();

       $logU=LoginUser::where('access_token',$access_token);
       $logU->line_user_id=$decoded_data['userId'];
       $logU->save();


        return;



    }



}
