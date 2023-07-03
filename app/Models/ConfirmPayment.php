<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfirmPayment extends Model
{
    use HasFactory;
    protected $table='confirm_payment';
    protected $guarded=[];
}
