<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\Route;
use App\Models\LineuserInflowRoute;

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
        return redirect('/redirect/index');
    }
}
