<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\models\Product;
use Illuminate\Support\Facades\DB;

class history extends Controller
{


    public function historyIndex(Request $request )
    {
      //Orderから持ってくるときに、同じUserIDのものを持ってくるとよい？
      // $orders = Order::all();
      //userのアクセストークンを取得
        return view('history');


    }

public function historyView(Request $request){
    $orders = new Order();
    $orders = Order::where('user_id',$request->_token)->get();
    $nm = Order::with('product')->get;

    //商品名を持ってくる
   // $productNm =  $this -> $orders -> product->name->get();


    return view ('history',[
      'items' => $orders,

    ]);

}
}
