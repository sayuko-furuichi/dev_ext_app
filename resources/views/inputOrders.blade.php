<!DOCTYPE html>
<html lang="ja">

<head>
    {{-- TODO:LINE ユーザIDを取得してDBに一緒に放り込む --}}

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ secure_asset('/css/liff.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('/css/reset.css') }}">
    {{-- <script src="https://unpkg.com/glottologist"></script> --}}
    <title>注文</title>
</head>

<body>
    <script charset="utf-8" src="https://static.line-scdn.net/liff/edge/2/sdk.js"></script>
    <script src="{{ secure_asset('/js/home.js') }}"></script>
    <h1>input Orders</h1>
    {{-- <form method="GET">
    @csrf
    <button type="submit"  action="/user" >user_token</button>    
</form> --}}
    <a href="{{ route('kaikei') }}">会計</a>
    <a href="{{ route('yoyaku') }}">予約</a>
    <a
        href="https://liff.line.me/1654883656-XqwKRkd4?aid=060rxmbw&utm_source=LINE&utm_medium=Owner&utm_campaign=Share">ショップカード</a>
    <form method="get">
        <a href="{{ route('history.index') }}">注文履歴</a>
        </input>
    </form>
    <hr>
    @if (isset($message))
        <p style="color: red"> {{ $message }}</p>
    @endif
    <div>
        <table>
            <tr>
                <th>id</th>
                <th>name</th>
                <th>price</th>
                <th>数量</th>
                <th></th>
            </tr>
           
                    @foreach ($items as $item)
                    <form method="post">
                        @csrf
                    <tr>
                        <td> <input type="hidden" name="products_id" value="{{ $item->id }}">{{ $item->id }}
                        </td>
                        <td name="name" value="{{ $item->name }}">{{ $item->name }}</td>
                        <td name="price"><input type="hidden" name="price"
                                value="{{ $item->price }}">{{ $item->price }}</td>
                        <td><input type="number" name="number" value="{{$item->number}}"></td>
<td >  <input type="submit" value="追加"></td>
                    </tr>
         
                @endforeach
                <a href="{{ route('inputOrders.rgst', ['products_id' =>'products_id'  , 'number' => 'number', 'price' => 'price']) }}"></a>

                    </form>
                 </table>
    </div>
{{--  orderが通った時、表示していく  --}}
{{-- 1件ずつの登録でいいんで、 add　→submitの流れで行きたい。  --}}
{{--countで行けるかも？--}}
  
    </form>

    <hr>
    <button style="color: forestgreen" type="text">店員を呼ぶ</button>

</body>

</html>
