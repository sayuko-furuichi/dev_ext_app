<!DOCTYPE html>
<html lang="ja">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{--  <script src="https://unpkg.com/glottologist"></script>  --}}
    <title>DB</title>
</head>
<body>
    <h2>登録されたユーザデータ</h2>
    <font color=red><p>一部の項目を省略し、新しく追加されたものから上位10件を表示しています</p></font>
    <font color=red><p>idが10ずつ増加しているのは利用しているシステムの仕様です</p></font>
<div>
<table border="3">
    <tr>
        <th>id</th>
        <th>LINEユーザID</th>
        <th>ユーザ名</th>
        <th>プロフィールメッセージ</th>
        {{--  <th>プロフィール画像のURL</th>  --}}
        <th>ユーザの端末のOS</th>
        <th>アプリが起動された画面</th>
        <th>DBに追加された日時</th>
    </tr>
    @if(isset($items))

    @foreach ($items as $item)
    <tr>
        <td> {{ $item->id }}</td>
        <td >{{ $item->line_user_id }}</td>
        <td>{{ $item->line_user_name }}</td>
        <td>{{ $item->prof_msg }}</td>
        {{--  <td>{{$item->prof_img_url}}</td>  --}}
        <td>{{$item->user_os}}</td>
        <td>{{$item->user_trans}}</td>
        <td>{{$item->created_at}}</td>

    </tr>
    @endforeach
    @endif

</table>
</div>
<script charset="utf-8" src="https://static.line-scdn.net/liff/edge/2/sdk.js"></script>
{{--  <script src="js/jquery-1.9.0.min.js" type="text/javascript"></script>  --}}
{{--  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>  --}}
{{--  <script src="js/getuser.js"></script>  --}}
</body>

</html>