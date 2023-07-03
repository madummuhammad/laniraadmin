<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
	protected $guarded=[];
	function product()
	{
		return $this->belongsTo('App\Models\Product');
	}
    
}
