<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detail_Procurement extends Model
{
    protected $table = 'detail_procurement';
    protected $fillable = ['id_procurement', 'title', 'amount', 'unit', 'is_approved'];
}
