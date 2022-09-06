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
    <p>Richmenu maNG</p>

    <p>ようこそ！ <span id="displayNameField"> </span> さん</p>
    
    <div>
        <form action="POST">
            @csrf
            <a href="{{route('rm.list')}}"></a>
            <button type="submit">送信</button>

        </form>
    </div>
  {{--  紐付いているものはまとめて表示する処理  --}}
    <div>
        <table border="3">
            <tr>
            <th> </th>
            <th>name</th>
            <th>chat_bar</th>
            <th>is_default</th>
            <th>richmenu_alias_id</th>
            <th>img</th>
            </tr>
        @if (isset($rmList))
          @foreach ($rmList as $rm)
          {{--  エイリアスIDでまとめる方法：aだけ取得する→aと一致するもの取得  --}}
        <tr>
            <td><input type="radio" name="rich" value={{$rm->rich_menu_id}}></td>
            <td><img src="{{secure_asset('img/'.$rm->img)}}" alt="img" width="30%"> </td>
        @if ($rm->is_default==1)
        <td><font color="red">{{$rm->name}}</td></font>
        @else
        <td>{{$rm->name}}</td>
        @endif
            <td>{{$rm->chat_bar}}</td>
            <td>{{$rm->is_default}}</td>
            <td>{{$rm->richmenu_alias_id}}</td>
           
       </tr>
       @endforeach  
       @endif
    </table>
      
    </div>
 
    

    {{--  <script charset="utf-8" src="https://static.line-scdn.net/liff/edge/2/sdk.js"></script>  --}}
    <script src="js/jquery-1.9.0.min.js" type="text/javascript"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    {{--  <script src="js/home.js"></script>  --}}
</body>

</html>
