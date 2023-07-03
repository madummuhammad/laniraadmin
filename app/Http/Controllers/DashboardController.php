<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Product;
use App\Models\Order;
class DashboardController extends Controller
{
    public function index()
    {
        $data['member']=Member::get()->count();
        $data['product']=Product::get()->count();
        $data['order']=Order::get()->count();
        return view('admin.dashboard',$data);
    }
}
