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

   
    try {
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
}catch(ErrorException){

  return session()->flash('flash_message', '取得に失敗しました');
}


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
        if (isset($decoded_data['userId']) && $decoded_data['userId'] != 'undefile' && $decoded_data['userId'] != null) {
            $up->line_user_id=$decoded_data['userId'];
        } else {
            $up->line_user_id="";
        }
        
        if (isset($decoded_data['displayName']) && $decoded_data['displayName'] != 'undefile' && $decoded_data['displayName'] != null) {
            $up->line_user_name=$decoded_data['displayName'];
        } else {
            $up->line_user_name="";
        }

        if (isset($decoded_data['pictureUrl']) && $decoded_data['pictureUrl'] != 'undefile' && $decoded_data['pictureUrl'] != null) {
            $up->prof_img_url=$decoded_data['pictureUrl'];
        } else {
            $up->prof_img_url="";
        }

        if (isset($decoded_data['statusMessage']) && $decoded_data['statusMessage'] != 'undefile' && $decoded_data['statusMessage'] != null) {
            $up->prof_msg=$decoded_data['statusMessage'];
        } else {
            $up->prof_msg="";
        }
    
        //取得不可なので空文字でinsert
        $up->user_os="";
        $up->user_trans="";
        $up->save();

        //TODO:Login_userテーブルにuserIdを格納(pivotつくるわ)

        return $up;
    }
}
