<?php

namespace App\Http\Controllers;
use App\Models\Expedisi;
use Illuminate\Http\Request;

class ExpedisiController extends Controller
{
    public function index()
    {
        $data['expedisi']=Expedisi::get();
        return view('admin.expedisi',$data);
    }

    public function update(Request $request)
    {
        $expedisi=Expedisi::get();

        foreach ($expedisi as $key => $value) {
            $id=request('id_'.$value['rate_name']);
            $status=request($value['rate_name']);
            if($status){
                $status=1;
            } else {
                $status=0;
            }
            Expedisi::where('id',$id)->update(['status'=>$status]);
            // $expedisi->updateStatus($id,$status);
        }
        return back();
    }
}
