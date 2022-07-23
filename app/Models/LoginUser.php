<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginUser extends Model
{
    use HasFactory;
    protected $table = 'login_users';
    protected $fillable =['line_user_id','access_token','refresh_token','scope'];
}
