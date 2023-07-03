<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded=[];

    
    function product_size()
    {
        return $this->hasMany('App\Models\ProductSize');
    }
}
