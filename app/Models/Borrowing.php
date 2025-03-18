<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    protected $table = 'borrowing';

    protected $fillable = ['id_division', 'id_asset', 'name', 'reason', 'return_date', 'added_date', 'borrowing', 'status'];

    public function asset()
    {
        return $this->belongsTo(Asset::class, 'id_asset');
    }

    public function division()
    {
        return $this->belongsTo(Division::class, 'id_division');
    }
}
