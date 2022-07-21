<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Models\Order;

class Order extends Model
{
    use HasFactory;
    //fill()で使うやつ
   protected $fillable =['products_id','number','user_id','total_amount'];
   // protected $fillable =['Products_id','number'];

    public function product(){
        return $this->belongsTo('App\Models\Order', 'id','products_id');
    }
}
