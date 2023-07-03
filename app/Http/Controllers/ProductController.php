<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\Brand;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
class ProductController extends Controller
{
    public function index()
    {
        $data['product']=Product::get();
        return view('admin.product',$data);
    }
    public function delete(){
        $id=request('id');
        Product::where('id',$id)->delete();
        return redirect()->back();
    }

    public function add(){
        $data['brand']=Brand::get();
        return view('admin.add-product',$data);
    }

    public function edit($id){
        $data['product']=Product::where('id',$id)->with('product_size')->first();
        $data['brand']=Brand::get();
        return view('admin.edit-product',$data); 
    }

    public function add_proses(Request $request)
    {
        $name=$request->name_produk;
        $link=$request->link_katalog;
        $diskon=$request->diskon_produk;
        $brand=$request->brand;
        $type_product=$request->type_product;
        $description=$request->deskripsi_produk;
        $berat=$request->berat;

        $size=$request->size;
        $stok=$request->stok;
        $price=$request->price;

        $status=$request->status;
        $img = $request->file('img');

        if ($img) {
            $filename = time() . '.' . $img->getClientOriginalExtension();
            $img->move(public_path('image/product'), $filename);
        } else {
            $filename = 'default.png';
        }

        $product=Product::create([
            'name'=>$name,
            'link_katalog'=>$link,
            'diskon_produk'=>$diskon,
            'brand_id'=>$brand,
            'deskripsi'=>$description,
            'type_product'=>$type_product,
            'berat'=>$berat,
            'photo'=>$filename,
            'status'=>$status
        ]);

        for ($i=0; $i < count($size); $i++) { 
            ProductSize::create([
                'product_id'=>$product->id,
                'size'=>$size[$i],
                'stok'=>$stok[$i],
                'price'=>$stok[$i]
            ]);
        }

        return redirect('product');


    }

    public function edit_proses(Request $request,$id){
        $name=$request->name_produk;
        $link=$request->link_katalog;
        $diskon=$request->diskon_produk;
        $brand=$request->brand;
        $type_product=$request->type_product;
        $description=$request->deskripsi_produk;
        $berat=$request->berat;

        $size=$request->size;
        $size_id=$request->size_id;
        $stok=$request->stok;
        $price=$request->price;

        $status=$request->status;
        $img = $request->file('img');

        if ($img) {
            $filename = time() . '.' . $img->getClientOriginalExtension();
            $img->move(public_path('image/product'), $filename);
            $data=[
                'name'=>$name,
                'link_katalog'=>$link,
                'diskon_produk'=>$diskon,
                'brand_id'=>$brand,
                'deskripsi'=>$description,
                'type_product'=>$type_product,
                'berat'=>$berat,
                'photo'=>$filename,
                'status'=>$status
            ];
        } else {
            $data=[
                'name'=>$name,
                'link_katalog'=>$link,
                'diskon_produk'=>$diskon,
                'brand_id'=>$brand,
                'deskripsi'=>$description,
                'type_product'=>$type_product,
                'berat'=>$berat,
                'status'=>$status
            ];
        }


        Product::where('id',$id)->update($data);

        for ($i=0; $i < count($size); $i++) {
            if(isset($size_id[$i])){
                $sid[$i]=$size_id[$i];
            } else {
                $sid[$i]=NULL;
            }
            ProductSize::updateOrCreate(
                [
                    'id'=>$sid[$i]
                ],[
                    'product_id'=>$id,
                    'size'=>$size[$i],
                    'stok'=>$stok[$i],
                    'price'=>$stok[$i]
                ]
            );
        }

        return back();
    }

    public function sold()
    {
        $size=OrderItem::where('order_type','Ready Stok')->distinct('size_id')->get('size_id');

        $order=[];
        $data=[];
        foreach ($size as $keys => $value) {
            $order[$keys]=OrderItem::where('size_id',$value->size_id)->where('order_type','Ready Stok')->get();

            $qty=0;
            $penjualan=0;
            foreach ($order[$keys] as $key => $a) {
                $qty=$qty+$a->qty;
                $penjualan=$penjualan+$a->price;
            }

            $product[$keys]=OrderItem::where('size_id',$value->size_id)->with('product_size')->where('order_type','Ready Stok')->first();

            $data[$keys]=[
                'product_name'=>$product[$keys]->product_name,
                'size'=>$product[$keys]->product_size->size,
                'qty'=>$qty,
                'penjualan'=>$penjualan
            ];
        }

        $d['data']=$data;
        $d['type']='Ready Stok';
        return view('admin.product-sold',$d);
    }

    public function sold_po()
    {
        $size=OrderItem::where('order_type','PO')->distinct('size_id')->get('size_id');
        $order=[];
        $data=[];
        foreach ($size as $keys => $value) {
            $order[$keys]=OrderItem::where('size_id',$value->size_id)->where('order_type','PO')->get();

            $qty=0;
            $penjualan=0;
            foreach ($order[$keys] as $key => $a) {
                $qty=$qty+$a->qty;
                $penjualan=$penjualan+$a->price;
            }

            $product[$keys]=OrderItem::where('size_id',$value->size_id)->with('product_size')->where('order_type','PO')->first();

            $data[$keys]=[
                'product_name'=>$product[$keys]->product_name,
                'size'=>$product[$keys]->product_size->size,
                'qty'=>$qty,
                'size_id'=>$product[$keys]->product_size->id,
                'penjualan'=>$penjualan
            ];
        }

        $d['type']='PO';
        $d['data']=$data;
        return view('admin.product-sold',$d);
    }
}
