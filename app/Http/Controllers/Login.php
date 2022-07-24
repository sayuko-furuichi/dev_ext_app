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

    // private LoginUser $logU;
    private $logU;

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


    public function callback(Request $request)
    {
        $this->code= $request->code;

        $api_url ='https://api.line.me/oauth2/v2.1/token';

        //エンコードされたURLで通信する
        $headers = [ "Content-Type:application/x-www-form-urlencoded",];

        $curl_handle = curl_init();

        curl_setopt($curl_handle, CURLOPT_POST, true);
        curl_setopt($curl_handle, CURLOPT_URL, $api_url);
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS, "grant_type=authorization_code&code=$this->code&redirect_uri=https://dev-ext-app.herokuapp.com/public/callback&client_id=1657292332&client_secret=1b8433d37832199bf746a66e7d8a5a77");
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
        // curl_exec()の結果を文字列にする
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
        

        //実行
        $json_response = curl_exec($curl_handle);

        //close
        curl_close($curl_handle);

        //デコード
        $logdData = json_decode($json_response, true);

        //アクセス
        //  dd($decoded_data['access_token']);

        //エラーが解決しないので急しのぎだが
       // $access_token="eyJhbGciOiJIUzI1NiJ9.8UfdPW_1j1pNobRJMei71J_7SwIv2GYqOUzKxYm5v9pgCIrIaCS81LHoPoy62iaRsAJHNrDFK-OfTSnR-YVn_z_KJNey1VGtVgec_2ZOTjrNyq-D-oHhk2TTpNmLTru-I65nzwXXnM-Anuekh6wV7Haa0NpmYUMwLfS_yt7YwN0.fYUbi8GRoLpSNG9nIFst3iKJHb_CLBbu9CW_VNphR74";
   
        var_dump($logdData);
      //DBに格納
          $logUser =new LoginUser;
          $at=$logdData['access_token'];
         $logUser->access_token=$at;
         $logUser->refresh_token=$logdData['refresh_token'];
         $logUser->scope=$logdData['scope'];
         $logUser->line_user_id= "";
         
         $logUser->expires_in =$logdData['expires_in'];


         $logUser ->save();

        $up=$this->getProf($at);
        
        
        return view('getUser', [
            'users' =>$up,
        ]);

        //  return view('getUser');
    }

    /**
     *  function getProfile:アクセストークンからユーザのプロフィールを取得
     *
     * @param [type] $access_token
     * @return view
     */
    public function getProf($at)
    {
        $api_url ='https://api.line.me/v2/profile';

        //GETでリクエストする。
        $headers = [ "Authorization:Bearer $at",];

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
       
        //取得したプロフィールを保存
        //TODO:値が取れなかった場合の処理も実装する

        $up = new UserProf;
        $up->line_user_id=$decoded_data['userId'];
        $up->line_user_name=$decoded_data['displayName'];
        $up->prof_img_url=$decoded_data['pictureUrl'];
        $up->prof_msg=$decoded_data['statusMessage'];
    
        //取得不可なので空文字でinsert
        $up->user_os="";
        $up->user_trans="";
        $up->save();

        //Login_userテーブルにuserIdを格納(pivotつくるわ)
        /*
          $this->logU=DB::table('login_users')
         ->select('*')
         ->where('access_token',$access_token)
         ->orderBy('created_at','DESC')
         ->limit(1)
         ->get();


          $this->logU=LoginUser::where('access_token',$access_token)
          ->orderBy('created_at','DESC')
          ->first();

         $this->logU->line_user_id->fill($decoded_data['userId'])->save();
           */

        return $up;
    }
}
