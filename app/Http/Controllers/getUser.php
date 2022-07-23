<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserProf;
use Illuminate\Support\Facades\DB;

class getUser extends Controller
{
    private $state;
    private $code;
    private $encUrl;

    public function index(Request $request)
    {
        //ログインに成功してredirectされた場合
        if ($this->state ==$request -> state) {
            //得たcodeで、アクセストークンを取得する


            return view('getUser');
        }
        
        $this->code= $request->code;
        $this->encUrl;

        $api_url ='https://api.line.me/oauth2/v2.1/token';

        $data = [
        "grant_type" => "authorization_code" ,
        "code"=>$this->code,
        "redirect_uri"=>$this->encUrl,
        "client_id"=>"1657292332",
        "client_secret"=>"1b8433d37832199bf746a66e7d8a5a77",
                ];

        //ToJson
        $data = json_encode($data);
        $headers = [ "Content-Type:application/x-www-form-urlencoded"];



        $curl_handle = curl_init();

        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl_handle, CURLOPT_URL, $api_url);
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true); // curl_exec()の結果を文字列にする

        //実行
        $json_response = curl_exec($curl_handle);


        //close
        curl_close($curl_handle);

        //デコード
        $decoded_data = json_decode($json_response, true);
        dd();

        //アクセス
        $access_token = $decoded_data->access_token;
        $id_token = $decoded_data->id_token;

        echo($id_token);

        return view('getUser');
    }

    //TODO:ログインが出来なかったときのエラー処理

   

    /**
     *  function login :認可URLを生成してプロフィール表示画面へredirect
     *
     * @return redirect Response
     */
    public function login()
    {
        //認可URL生成
        $authUrl = "https://access.line.me/oauth2/v2.1/authorize?response_type=code&";

        $cbUrl="https://dev-ext-app.herokuapp.com/public/user";
    
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




    public function getUser(Request $request)
    {
        $lu = new UserProf;
        if (isset($request->id)) {
            $lu ->line_user_id = $request->id;
        } else {
            $lu ->line_user_id = "";
        }
        
        if (isset($request->nm)) {
            $lu ->line_user_name = $request->nm;
        } else {
            $lu ->line_user_name = "";
        }
        
        if (isset($request->msg)) {
            $lu ->prof_msg =  $request->msg;
        } else {
            $lu ->prof_msg = "";
        }

        if (isset($request->os)) {
            $lu ->user_os = $request->os;
        } else {
            $lu ->user_os  = "";
        }

        if (isset($request->msg)) {
            $lu ->user_trans = $request->con;
        } else {
            $lu ->user_trans= "";
        }

        if (isset($request->url)) {
            $lu ->prof_img_url =  $request->url;
        } else {
            $lu ->prof_img_url = "";
        }

       



        $lu->save();

        // $lu -> save();
        echo "$lu";

        return redirect('/user');
    }


    //DBのデータ閲覧

    public function dbshow()
    {
        $items = DB::table('user_profs')
        -> select('*')
        ->orderBy('created_at', 'DESC')
        ->limit(10)
        ->get();
        
        return view('dbshow', [
            'items' => $items
        ]);
    }
}
