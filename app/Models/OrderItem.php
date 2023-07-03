<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table='orders_item';

    function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    function product_size()
    {
        return $this->belongsTo('App\Models\ProductSize','size_id','id');
    }
}
