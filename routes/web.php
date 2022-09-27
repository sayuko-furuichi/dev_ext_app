<?php

use Illuminate\Support\Facades\Route;
use app\Http\Controllers\SendServiceMsg;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RichMenus;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('entrance');
});

//Route::get('/','App\Http\Controllers\HomeController@index');

//login入口
Route::get('/login','App\Http\Controllers\Login@login')
->name('login.index');
//callback
Route::get('/callback','App\Http\Controllers\Login@callback');


//get user data
Route::get('/user','App\Http\Controllers\getUser@index')
->name('getuser.index');
//get user data POST
Route::post('/user','App\Http\Controllers\getUser@getUser')
->name('getuser.post');

//DBshow
Route::get('/dbshow','App\Http\Controllers\getUser@dbshow')
->name('getuser.show');

//会計
Route::get('/kaikei','App\Http\Controllers\kaikei@index')-> name('kaikei');

//予約
Route::get('/yoyaku','App\Http\Controllers\yoyaku@index')
-> name('yoyaku');

//注文
Route::get('/inputOrders','App\Http\Controllers\InputOrders@index')-> name('inputOrders.index');
Route::post('/inputOrders/{products_id?}/{number?}','App\Http\Controllers\InputOrders@inputOrder')

-> name('inputOrders.rgst');

//注文履歴
Route::get('/history', 'App\Http\Controllers\history@historyIndex')
->name('history.index'); 
Route::post('/history', 'App\Http\Controllers\history@historyView')
->name('history.view');
    

//スタンプ
Route::get('/stamp','App\Http\Controllers\stamp@index')-> name('stamp');

//send service message
// Route::get('/send','App\Http\Controllers\HomeController@getUser')-> name('sendsm');

//0801 demo
Route::get('/lp','App\Http\Controllers\Flows@index')->name('flows.index');
Route::get('/official','App\Http\Controllers\Flows@off')->name('flows.off');
Route::get('/members','App\Http\Controllers\Flows@member')->name('flows.member');


//0902 リッチメニュー表示
Route::controller(RichMenus::class)->group(function(){
    Route::get('/rich','index')->name('rm.index');
    // Route::get('/rich/{id}','index')->name('rm.send');
    Route::post('/rich','send')->name('rm.send');
});

//0912 serverAPI Add_Liff
Route::get('/serve','App\Http\Controllers\Cats@index')->name('server.index');
Route::post('/serve','App\Http\Controllers\Cats@send')->name('server.send');

//公式アカウントへredirect
Route::get('/redirect','App\Http\Controllers\Redirect@redirect')->name('redirect.index');
Route::get('/redirect/index','App\Http\Controllers\Redirect@index')->name('inflow.index');
Route::post('/redirect/index','App\Http\Controllers\Redirect@add')->name('inflow.add');

Route::group(['prefix' => '/access', 'as' => 'getinflow' ], function () {
    Route::get('/', 'App\Http\Controllers\GetInflowRoutes@access')-> name('.access');
});