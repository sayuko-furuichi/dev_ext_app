<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginUser extends Model
{
    use HasFactory;
    protected $table = 'login_users';
    protected $fillable =['access_token','line_user_id','refresh_token','scope','expires_in'];
}
