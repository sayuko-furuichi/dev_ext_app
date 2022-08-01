<!DOCTYPE html>
<html lang="ja">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/glottologist"></script>
    <title>extarnal_web_app</title>
</head>

<body>

    <h1>会員登録ページ</h1>
    {{--  <a href="{{route('getuser.show')}}">登録されたデータを確認する</a>  --}}
    <hr>

        <div class="note"></div>
        <h2>以下の情報で登録します</h2>
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
            <div class="profile-info" >
                {{--  <p>LINEユーザ名： <span id="displayNameField"> </span></p>  --}}
                <p>LINEユーザ名： <input type="text" value="{{$users->line_user_name}}"></p>

                <p>LINEユーザID： <span> {{$users->line_user_id}}</span></p>
                <p>プロフィールメッセージ： <span> {{$users->prof_msg}} </span> </p>
                <p>メールアドレス： <input type="text" style="width:25%"> <span> @ </span> <input type="text" style="width:25%"></p>
                <p>電話番号： <input type="text" style="width:20%"> <span> - </span> <input type="text" style="width:20%"> <span> - </span> <input type="text" style="width:20%"></p>
                
                {{-- 動作環境 --}}
                @endif

         {{--  <form method="POST" name="fm">  
                    @csrf
                    <a href="{{route ('getuser.post',['nm'=>'nm','id'=>'id','msg'=>'msg','os'=>'os','con'=>'con','url'=>'url'])}}"></a>
                    <button type="submit">登録する</button>  --}}
                 <p style="color: blue">登録する        ※押せません</p>
               

            </div>
        </div>
</form>
        {{--  <script charset="utf-8" src="https://static.line-scdn.net/liff/edge/2/sdk.js"></script>  --}}
        <script src="js/jquery-1.9.0.min.js" type="text/javascript"></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        {{--  <script src="js/getuser.js"></script>  --}}
</body>

</html>
