<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Procurement extends Model
{
    protected $table = 'procurement';

    protected $fillable = ['id_admin', 'id_user', 'name_division', 'reason', 'status', 'code'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'id_admin');
    }

    public function details()
    {
        return $this->hasMany(Detail_Procurement::class, 'id_procurement', 'id');
    }
}
