<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add_Liff</title>
</head>
<body>
    <h1>Add_Liff&getCat</h1>
    <form action="{{route('server.send')}}">
        @if (isset($token))
            <div class="flash_message">
               <p>{{$token}}</p> 
            </div>
        @endif
        <p>LIFFアプリ名:</p>
        <input type="text" name="liff_name">
        <button type="submit">LIFFアプリ作成</button>
    </form>
</body>
</html>