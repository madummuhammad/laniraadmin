<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Order;
class MemberController extends Controller
{
    public function index(){
        $data['member']=Member::get();
        return view('admin.member',$data);
    }

    public function add(){
        return view('admin.add-member');
    }

    public function add_proses(Request $request){
        $name=$request->nama;
        $email=$request->email;
        $password=$request->email;
        $no_wa=$request->no_wa;

        $data=[
            'nama'=>$name,
            'email'=>$email,
            'password'=>md5($password),
            'no_wa'=>$no_wa,
        ];

        Member::create($data);

        return redirect('member');
    }

    public function edit($id)
    {
        $data['member']=Member::where('id',$id)->first();
        return view('admin.edit-member',$data);
    }

    public function edit_proses(Request $request,$id)
    {
        $name=$request->nama;
        $email=$request->email;
        $password=$request->email;
        $no_wa=$request->no_wa;
        if($password){            
            $data=[
                'nama'=>$name,
                'email'=>$email,
                'password'=>md5($password),
                'no_wa'=>$no_wa,
            ];
        } else {
            $data=[
                'nama'=>$name,
                'email'=>$email,
                'no_wa'=>$no_wa,
            ];
        }

        Member::where('id',$id)->update($data);

        return back();
    }

    public function delete(){
        $id=request('id');

        Member::where('id',$id)->delete();
        return back();
    }


    public function history($id)
    {
        $data['order']=Order::where('member_id',$id)->with('order_item')->get();
        return view('admin.member-history',$data);
    }

    public function filter($id){
        $month=request('bulan');
        $year=request('tahun');

        $query=Order::where('member_id',$id)->with('order_item');

        if($month){
            $query->whereMonth('order_time',$month);
        }

        if($year){
            $query->whereYear('order_time',$year);
        }
        $data['order']=$query->get();
        return view('admin.member-history',$data);   
    }
}
