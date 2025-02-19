<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';
    protected $fillable = ['id_division', 'first_name', 'last_name', 'email', 'no_hp', 'role', 'password', 'slug'];

    public function division()
    {
        return $this->belongsTo(Division::class, 'id_division');
    }
}
