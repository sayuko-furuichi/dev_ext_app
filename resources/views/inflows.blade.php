<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<a href="{{route('redirect.access')}}">履歴確認へ</a>
    <h1>まるや　流入経路設定</h1>
    <form action="{{route('inflow.add')}}" method="POST">
        @csrf
        <p>経路名：</p>
        <p><input type="text" name="name"></p>

        <input type="submit" value="追加">

    </form>
@if (isset($qr) && isset($url))
<p>流入経路名：</p>
<p>{{$name}}</p>
<td>  </td>
<p>QRコード：</p>
<img src="{{secure_asset($qr)}}" alt="QRコード">
<p>リンク先URL：</p>
<p>{{$url}}</p>
@endif
</body>
</html>