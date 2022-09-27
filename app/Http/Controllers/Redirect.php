<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\Route;
use App\Models\LineuserInflowRoute;

// use App\SimpleSoftwareIO\QrCode\QrCodeServiceProvider;
 use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Redirect extends Controller
{
    //
    function redirect(Request $request){
       $store= Store::where('id',$request->store)->first();
       $route=Route::where('id',$request->route)->first();

       $inflow = new LineuserInflowRoute;
       $inflow->store_id=$store->id;
       $inflow->route=$route->route_name;
       $inflow->save();

        return redirect($store->account_url);
    }

    function index(){
        return view('inflows');
    }
    function add(Request $request){
        $nwRoute = new Route;
        $nwRoute->route_name=$request->name;
        $nwRoute->save();
        $nwRoute->id;


//QRコード生成
  //     QrCode::generate('https://dev-ext-app.herokuapp.com/public/redirect?store=4&route='.$nwRoute->id,secure_asset('img/qr/'.$nwRoute->id .'.png'));
  QrCode::generate('https://dev-ext-app.herokuapp.com/public/redirect?store=4&route='.$nwRoute->id,'../public/img/qr/qr.svg');  
  $qr=secure_asset('img/qr/qr');
            $qrs[]=['qr'=>$qr,'url'=>'https://dev-ext-app.herokuapp.com/public/redirect?store=4&route='.$nwRoute->id];
        return redirect('/redirect/index')->with($qrs);
    }
}
