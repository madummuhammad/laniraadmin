<?php

namespace App\Http\Controllers;
use App\Models\FooterContent;
use App\Models\Slider;

use Illuminate\Http\Request;

class WebController extends Controller
{
    public function footer(){
        $data['footer']=FooterContent::first();
        return view('admin.footer',$data);
    }

    public function footer_edit(){
        $about=request('about');
        $contact=request('contact');
        $email=request('email');

        $data=[
            'about'=>$about,
            'contact'=>$contact,
            'email'=>$email
        ];

        FooterContent::where('id',1)->update($data);
        return back();
    }

    public function slider(){
        $data['slider']=Slider::get();
        return view('admin.slider',$data);
    }

    public function slider_delete(){
        $id=request('id');

        Slider::where('id',$id)->delete();
        return back();
    }

    public function add_slider(Request $request){
        $image = $request->file('image');

        if ($image) {
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('image/sliders'), $filename);
        }

        Slider::create(['gambar'=>$filename]);

        return back();
    }

    public function edit_slider(Request $request){
        $id=$request->id;
        $image = $request->file('image');

        if($image) {
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('image/sliders'), $filename);
            Slider::where('id',$id)->update(['gambar'=>$filename]);
        }


        return back();
    }
}
