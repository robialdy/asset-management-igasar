<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $table = 'request';

    protected $fillable = ['id_user', 'id_admin', 'division_name', 'type', 'id_asset', 'status', 'description'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'id_admin');
    }

    public function asset()
    {
        return $this->belongsTo(Asset::class, 'id_asset');
    }
}
