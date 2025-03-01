<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_Ownership extends Model
{
    protected $table = 'user_ownership';
    protected $fillable = ['code_ownership', 'id_user', 'id_asset', 'attachment', 'return_attachment', 'return_at'];
}
