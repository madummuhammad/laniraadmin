<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    function product_size()
    {
        return $this->belongsTo('App\Models\ProductSize');
    }

    function member()
    {
        return $this->belongsTo('App\Models\Member');
    }
}
