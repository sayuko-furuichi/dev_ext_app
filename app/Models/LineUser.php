<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineUser extends Model
{
    use HasFactory;
        // protected $fillable =['line_userid','service_message_token''channel_access_token',];
        protected $fillable =['line_userid','liff_access_token'];
}
