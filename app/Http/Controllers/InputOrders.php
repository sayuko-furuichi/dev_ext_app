<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;

class InputOrders extends Controller
{
    public function index(Request $request)
    {
      //  $items = Product::where('id', '1')->first();
        //$items = Product::all();
        $items = Product::where('stock_flag', '1')->get();
        $count=0;
        $order = new Order;

        return view(
            'inputOrders',
            [
          'items' => $items,
          'count' => $count,
          'od' => $order
            
        ]
        );
    }

    public function inputOrder(Request $request )
    {
        //注文をすべてorderインスタンスに格納
        //複数個の注文の時には、回して代入する？
       // $form = $request->all();
       
     /*  foreach ($request as $rq) {
            if (isset($rq->number)) {
                // unset($form['_token']);
                $order->total_amount = $rq ->price * $request ->number;
       
                //！！DemoとしてLIFFのユーザアクセストークンを代入してます
                $order->user_id = $rq -> _token;
                $order->products_id = $rq ->products_id;
                $order->number = $rq ->number;
                $order ->save();
            }
        }
       
*/

        //  foreach ($request as $rq) {
                  // unset($form['_token']);
                  $order = new Order;
                  $order->total_amount = $request ->price * $request ->number;

                  //！！DemoとしてLIFFのユーザアクセストークンを代入してます
                  $order->user_id = $request -> _token;
                  $order->products_id = $request ->products_id;
                  $order->number = $request ->number;
               //   $name =$request->name;
                  
               if (isset($request->number)){

                  
                      $order ->save();
                    }

        $message = "Thank you! Please wait until it arrives...";
       
        //初期表示の商品を表示
        // $items = Product::where('id', '1')->first();
        $items = Product::where('stock_flag', '1')->get();

        return view('inputOrders', [
          'items' => $items,
       //   'orders'=> $orders,
          'message' => $message,
       
            
        ]);
      }
    }
    

