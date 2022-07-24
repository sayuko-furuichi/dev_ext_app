<!DOCTYPE html>
<html lang="ja">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <link rel="stylesheet" href="{{ secure_asset('css/liff.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ secure_asset('css/reset.css') }}"> --}}
    {{-- <link id="import-link" rel="import" href="./sub.html"> --}}
    <script src="https://unpkg.com/glottologist"></script>
    <title>extarnal_web_app</title>
</head>

<body>

    <h1>getUser</h1>
    <a href="{{route('getuser.show')}}">登録されたデータを確認する</a>
    <hr>
{{--  
        <form method="get">
            @csrf
            <button type="submit" href="{{ route('getuser.index') }}">user</button>
        </form>

        <a href="{{ route('kaikei') }}">会計</a>
        <a href="{{ route('yoyaku') }}">予約</a>
        <a
            href="https://liff.line.me/1654883656-XqwKRkd4?aid=060rxmbw&utm_source=LINE&utm_medium=Owner&utm_campaign=Share">ショップカード</a>
        <a href="{{ route('inputOrders.index') }}">注文</a>
        <a href="https://liff.line.me/1657181787-2vrnwwlj">LIFFへ遷移</a>
       
        <a href="https://lin.ee/mjCgvBo">発行中のクーポン</a>
        <a href="https://line-logins.herokuapp.com/gotoauthpage">line_login</a>
  --}}

        <div class="note"></div>
        <h2>あなたのプロフィール</h2>
        @if (isset($err))
            <p>{{$err}}</p>
        @endif
        @if(isset($users))
        <div id="profileInfo">
            <p>プロフィール画像：</p>
            <div id="profilePictureDiv" class="profile-picture">
                @if($users->prof_img_url != "" && $users->prof_img_url != "undefine")
                <img src={{$users->prof_img_url}} width="30%" alt="prof_img">
                @endif
            </div>
            <div class="profile-info">
                {{--  <p>LINEユーザ名： <span id="displayNameField"> </span></p>  --}}
                <p>LINEユーザ名： <span>{{$users->line_user_name}}</span></p>

                <p>LINEユーザID： <span> {{$users->line_user_id}}</span></p>
                <p>プロフィールメッセージ： <span> {{$users->prof_msg}} </span> </p>
                
                {{-- 動作環境 --}}
                <font color="green">動作環境 <span> <font color="red"> ※LINEログインAPIでは取得できません</font></span></font>
                <p> 起動しているOS： <span id="osField"> </span> </p>
                <p> 起動された画面： <span id="contextField"> </span> </p>
            
                @endif

              
          {{--  <form method="POST" name="fm">  
                    @csrf
                    <a href="{{route ('getuser.post',['nm'=>'nm','id'=>'id','msg'=>'msg','os'=>'os','con'=>'con','url'=>'url'])}}"></a>
                    <button type="submit">送信</button>

                    --}}
                    
{{--  POST用  
                <input type="hidden" id="displayNameps"  name="nm">
                <input type="hidden" id="userIdProps" value="" name="id">
                <input type="hidden" id="statusMessageps" value="" name="msg">
                <input type="hidden" id="osps" value="" name="os">
                <input type="hidden" id="conteps" value="" name="con">
                <input type="hidden" id="urlps" value="" name="url">
                --}}
                {{--  prof画像のURL url  --}}

               

            </div>
        </div>
</form>
        <script charset="utf-8" src="https://static.line-scdn.net/liff/edge/2/sdk.js"></script>
        <script src="js/jquery-1.9.0.min.js" type="text/javascript"></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <script src="js/getuser.js"></script>
</body>

</html>
