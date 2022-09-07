<!DOCTYPE html>
<html lang="ja">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <link rel="stylesheet" href="{{ secure_asset('css/liff.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ secure_asset('css/reset.css') }}"> --}}
    {{-- <link id="import-link" rel="import" href="./sub.html"> --}}
    <title>RMM</title>
</head>

<body>

    <h1>Rich_Menus_Manager</h1>
    <p>デフォルトにしたいリッチメニューを選択してください</p>
    <p>あとでエイリアスでまとめます</p>

    {{-- 紐付いているものはまとめて表示する処理 --}}
    <div>
        <table border="3">
            <tr>
                <th> </th>
                <th>img</th>
                <th>name</th>
                <th>chat_bar</th>
                <th>is_default</th>
                <th>richmenu_alias_id</th>

            </tr>
            <form method="POST" name="id">
                @csrf

                @if (isset($rmList))
                    @foreach ($rmList as $rm)
                        {{-- エイリアスIDでまとめる方法：aだけ取得する→aと一致するもの取得 --}}
                        
                            @if ($rm->is_default == 1)
                            <tr style="color:red">
                             
                                    <td>☆</td>
                                    <td><img src="{{ secure_asset('img/' . $rm->img) }}" alt="img" width="80%">
                                    <td>{{ $rm->name }}</td>
                                    <td>{{ $rm->chat_bar }}</td>
                                <td>{{ $rm->is_default }}</td>
                                <td>{{ $rm->richmenu_alias_id }}</td>
                            @else
                            <tr>
                                <td><input type="radio" name="id" value="{{ $rm->richmenu_id }}"></td>
                                <a href="{{ route('rm.send') }}"></a>
                                <td><img src="{{ secure_asset('img/' . $rm->img) }}" alt="img" width="80%">
                                </td>
                                <td>{{ $rm->name }}</td>
                                <td>{{ $rm->chat_bar }}</td>
                                <td>{{ $rm->is_default }}</td>
                                <td>{{ $rm->richmenu_alias_id }}</td>
                            @endif
                        </tr>
                    @endforeach
                    <button type="submit">送信</button>
            </form>
            @endif
        </table>

    </div>


</body>

</html>
