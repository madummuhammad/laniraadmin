<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
    public function index()
    {
        $data['cart']=Cart::with('member','product_size.product')->get();
        return view('admin.cart',$data);
    }
}
