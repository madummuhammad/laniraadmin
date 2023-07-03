<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function member()
    {
        return $this->belongsTo('App\Models\Member');
    }

    public function order_item()
    {
        return $this->hasMany('App\Models\OrderItem');
    }

    public function payment_confirm()
    {
        return $this->hasMany('App\Models\ConfirmPayment');
    }
}
