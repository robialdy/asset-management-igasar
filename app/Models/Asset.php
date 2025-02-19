<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $table = 'assets';

    protected $fillable = ['code_asset', 'name', 'description', 'picture', 'type', 'id_category', 'added_date', 'status', 'pic_payment'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_categoory');
    }
}
