<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asset extends Model
{
    protected $table = 'assets';

    protected $fillable = ['code_asset', 'name', 'description', 'picture', 'type', 'id_category', 'added_date', 'status', 'pic_payment', 'stock', 'unit', 'qr_code'];

    use SoftDeletes;

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category');
    }

    public function details()
    {
        return $this->hasMany(Detail_Asset::class, 'id_asset', 'id');
    }
}
