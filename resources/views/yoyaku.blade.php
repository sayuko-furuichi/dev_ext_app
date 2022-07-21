<!DOCTYPE html>
<html lang="ja">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ secure_asset('/css/liff.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('/css/reset.css') }}">
    {{-- <script src="https://unpkg.com/glottologist"></script> --}}
    <title>予約</title>
</head>

<body>
    <script charset="utf-8" src="https://static.line-scdn.net/liff/edge/2/sdk.js"></script>
    <script src="{{ secure_asset('/js/home.js') }}"></script>

    <p>Hello!!! world!!!! LINEMINI APP</p>
    <form method="GET">
        @csrf
        <button type="submit" action="/user">user</button>
    </form>
    <a href="{{ route('kaikei') }}">会計</a>

    <a
        href="https://liff.line.me/1654883656-XqwKRkd4?aid=060rxmbw&utm_source=LINE&utm_medium=Owner&utm_campaign=Share">ショップカード</a>
    <a href="{{ route('inputOrders.index') }}">注文</a>



</body>

</html>
