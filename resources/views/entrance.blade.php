<!DOCTYPE html>
<html lang="ja">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     {{--  <link rel="stylesheet" href="{{ secure_asset('css/liff.css') }}">    --}}
    {{--  <link rel="stylesheet" href="{{ secure_asset('css/reset.css') }}">    --}}
    {{--  <link id="import-link" rel="import" href="./sub.html">  --}}
    <script src="https://unpkg.com/glottologist"></script> 
    <title>WELCOME</title>
</head>

<body>

    <h1>home</h1>
    <p>Hello!!! world!!!! LINEMINI APP</p>

    <p>ようこそ！ <span id="displayNameField"> </span> さん</p>
    

   <form method="get"> 
       @csrf 
     <button type="submit" href="{{ route('getuser.index') }}">user</button>
      </form> 
  
    <a href="{{route('getuser.index') }}">ユーザデータ取得</a>


  
    <a href="{{ route('kaikei') }}">会計</a>
    <a href="{{ route('yoyaku') }}">予約</a>
    <a
        href="https://liff.line.me/1654883656-XqwKRkd4?aid=060rxmbw&utm_source=LINE&utm_medium=Owner&utm_campaign=Share">ショップカード</a>
    <a href="{{ route('inputOrders.index') }}">注文</a>
    <a href="https://liff.line.me/1657181787-2vrnwwlj">LIFFへ遷移</a>
    <a href="https://lin.ee/mjCgvBo">発行中のクーポン</a>
    <a href="https://line-logins.herokuapp.com/gotoauthpage">line_login</a>
    <a href="https://line.me/R/nv/location/">ichi</a>

    <div class="note">

        <p glot-model="note1"></p>
        <p glot-model="note2"></p>
    </div>
    <div id="profileInfo">
        <div id="profilePictureDiv" class="profile-picture" ></div>  
        <div class="profile-info">
            <h1 glot-model="companyName"></h1>
            <p glot-model="departmentName"></p>
            <p id="displayNameField"></p>
            <p id="userIdProfileField"></p>
            <p id="statusMessageField"></p>
        </div>
    </div>

    <script charset="utf-8" src="https://static.line-scdn.net/liff/edge/2/sdk.js"></script>
    <script src="js/jquery-1.9.0.min.js" type="text/javascript"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="js/home.js"></script>
</body>

</html>
