<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>まるや　流入経路設定</h1>
    <form action="{{route('inflow.add')}}" method="POST">
        @csrf
        <p>経路名：</p>
        <p><input type="text" name="name"></p>

        <input type="submit" value="追加">

    </form>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-7Q4M2C2Z43"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-7Q4M2C2Z43');
</script>
    
@if (isset($qrs))
<img src="{{$qrs['qr']}}" alt="">
<p>{{$qrs['url']}}</p>
@endif
</body>
</html>