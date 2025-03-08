<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Division_Ownership extends Model
{
    protected $table = 'division_ownership';
    protected $fillable = ['code_ownership', 'id_division', 'id_asset', 'attachment', 'return_attachment', 'return_at', 'added_date'];

    public function division()
    {
        return $this->belongsTo(Division::class, 'id_division');
    }
    public function asset()
    {
        return $this->belongsTo(Asset::class, 'id_asset');
    }
}
