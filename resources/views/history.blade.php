<!DOCTYPE html>
<html lang="ja">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <script src="https://unpkg.com/glottologist"></script> --}}
    <title>注文/履歴</title>
</head>

<body>
    <script charset="utf-8" src="https://static.line-scdn.net/liff/edge/2/sdk.js"></script>
    <h1>Order History</h1>
    {{-- <form method="GET">
        @csrf
        <button type="text" action="/user_token=">user</button>
    </form> --}}
    <a href="{{ route('kaikei') }}">会計</a>
    <a href="{{ route('yoyaku') }}">予約</a>
    <a href="{{ route('inputOrders.index')  }}">注文</a>
<a href="https://liff.line.me/1654883656-XqwKRkd4?aid=060rxmbw&utm_source=LINE&utm_medium=Owner&utm_campaign=Share">ショップカード</a>
    <hr>
    <form method="post">
        @csrf
    <input type="submit" value="確認する">
    <a href="{{route('history.view')}}"></a>
    
    
    </form>

  @if(isset($items)) 
    <div>
        <table>
            <tr>
                <th>product_id</th>
                <th>数量</th>
                <th>小計</th>
            </tr>
            <form method="get">
                 @foreach ($items as $item)  
                 {{--  @foreach ($pronm as $pnm)    --}}
                    <tr> 
                        {{--  <td name="products_id">{{ $pnm->name}}</td>  --}}
                        <td name="number">{{ $item->number }}</td>
                      <td name="subtotal">{{$item -> total_amount}}</td> 
                    </tr>
                  @endforeach  
        </table>
    </div>
    @else
    @endif
   
    </form>
    <input type="button" value="会計する">
    <a href="{{ route('kaikei') }}">{{--TODO:会計フラッグ利用？--}}
    
</body>

</html>
