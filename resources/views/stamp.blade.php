<!DOCTYPE html>
<html lang="ja">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{ secure_asset('/css/liff.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('/css/reset.css') }}">
    {{-- <script src="https://unpkg.com/glottologist"></script> --}}
    <title>スタンプ</title>
</head>

<body>
    <script charset="utf-8" src="https://static.line-scdn.net/liff/edge/2/sdk.js"></script>
    <script src="{{ secure_asset('/js/home.js') }}"></script>

    <p>Hello!!! world!!!! LINEMINI APP</p>
    <form method="GET">
        @csrf
        <button type="submit" action="/user">user</button>
        <a href="{{ route('kaikei') }}">会計</a>
        <a href="{{ route('yoyaku') }}">予約</a>

        <a href="{{ route('inputOrders') }}">注文</a>

    </form>
</body>

</html>
