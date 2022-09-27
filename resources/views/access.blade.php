<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>user_inflow_access</title>
</head>
<body>
    <h1>まる屋　流入経路_アクセス履歴</h1>

    <table border="3">
        <tr>
        <th>id</th>
        <th>name</th>
        <th>アクセス時刻</th>
    </tr>
    @if (isset($items))
    @foreach ($items as $item)
    <tr>
        <td>{{$item->id}}</td>
        <td>{{$item->route}}</td>
        <td>{{$item->created_at}}</td>
    </tr>
    @endforeach
    @endif
    </table>

</body>
</html>