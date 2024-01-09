<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\Order;
use App\Models\ConfirmPayment;
use App\Models\OrderItem;
use PDF;
use Auth;
use Illuminate\Support\Facades\DB;
class OrderController extends Controller
{
    public function ready_stock()
    {
        $data['order']=Order::where('order_type','Ready Stok')->with('payment_confirm')->orderBy('created_at','DESC')->get();
        return view('admin.order',$data);
    }

    public function po()
    {
        $data['order']=Order::where('order_type','PO')->with('payment_confirm')->orderBy('created_at','DESC')->get();
        return view('admin.order-po',$data);
    }

    public function deleteOrder()
    {
        $id=request('id');
        $order=Order::where('id',$id)->first();
        $data=[
            'order_id'=>$order->id,
            'order_time'=>$order->order_time,
            'order_status'=>$order->order_status,
            'confirm_payment'=>$order->confirm_payment,
            'member_id'=>$order->member_id,
            'order_email'=>$order->order_email,
            'nama_penerima'=>$order->nama_penerima,
            'order_tel'=>$order->order_tel,
            'address'=>$order->address,
            'catatan'=>$order->catatan,
            'phone'=>$order->phone,
            'provinsi'=>$order->provinsi,
            'distrik'=>$order->distrik,
            'tipe'=>$order->tipe,
            'ekspedisi'=>$order->ekspedisi,
            'paket'=>$order->paket,
            'estimasi'=>$order->estimasi,
            'ongkir'=>$order->ongkir,
            'berat'=>$order->berat,
            'voucher'=>$order->voucher,
            'resi'=>$order->resi,
            'total'=>$order->total,
            'phone_dropship'=>$order->phone_dropship,
            'sender_dropship'=>$order->sender_dropship,
            'order_type'=>$order->order_typ,
            'user_id'=>Auth::user()->id
        ];

        DB::table('order_deletes')->insert($data);
        Order::where('id',$id)->delete();
        OrderItem::where('order_id',$id)->delete();
        ConfirmPayment::where('order_id',$id)->delete();
        return back();
    }

    public function filter_rs(){
        $month=request('bulan');
        $year=request('tahun');

        $query=Order::where('order_type','Ready Stok')->with('order_item');

        if($month){
            $query->whereMonth('order_time',$month);
        }

        if($year){
            $query->whereYear('order_time',$year);
        }
        $data['order']=$query->get();
        return view('admin.order',$data);   
    }

    public function filter_po(){
        $month=request('bulan');
        $year=request('tahun');

        $query=Order::where('order_type','PO')->with('order_item');

        if($month){
            $query->whereMonth('order_time',$month);
        }

        if($year){
            $query->whereYear('order_time',$year);
        }
        $data['order']=$query->get();
        return view('admin.order-po',$data);   
    }

    public function detail_rs($id)
    {
        $data['order']=Order::where('id',$id)->where('order_type','Ready Stok')->with('order_item.product_size','payment_confirm')->first();
        return view('admin.order-detail-rs',$data);
    }

    public function detail_po($id)
    {
        $data['order']=Order::where('id',$id)->where('order_type','PO')->with('order_item.product_size','payment_confirm')->first();
        return view('admin.order-detail-po',$data);
    }

    public function add($id)
    {
        $data['id']=$id;
        $data['product']=Product::where('type_product','PO')->where('status','Publish')->get();
        return view('admin.add-order',$data);
    }

    public function delete(){
        $order_item_id=request('order_item_id');
        $order_id=request('order_id');
        $total=request('total');
        $price=request('price');
        OrderItem::where('id',$order_item_id)->delete();
        Order::where('id',$order_id)->update(['total'=>$total-$price]);
        ConfirmPayment::where('order_id',$order_id)->update(['jumlah'=>$total-$price]);
        return back();
    }

    public function add_order($id)
    {
        $size_id=request('size');
        $product_id=request('product_id');
        $qty=request('quantity');
        $product=Product::where('id',$product_id)->first();
        $size=ProductSize::where('id',$size_id)->first();
        $price=$size->price-($product->diskon_produk/100*$size->price);
        $data=[
            'order_id'=>$id,
            'product_id'=>$product_id,
            'product_name'=>$product->name,
            'qty'=>$qty,
            'price'=>$price,
            'order_type'=>'PO',
            'size_id'=>$size_id,
            'ct_status'=>'order',
        ];
        OrderItem::create($data);
        $OrderItem=OrderItem::where('order_id',$id)->get();
        $total=0;
        foreach ($OrderItem as $key => $oi) {
            $total=$total+$oi->price*$oi->qty;
        }


        // return $total;

        Order::where('id',$id)->update(['total'=>$total]);
        ConfirmPayment::where('order_id',$id)->update(['jumlah'=>$total]);
        return redirect('order/po/'.$id);
    }

    public function add_detail($id)
    {
        $data['id']=$id;
        $product_id=request('product_id');
        $data['product']=Product::where('id',$product_id)->with('product_size')->first();
        return view('admin.add-order-detail',$data);
    }

    public function update_qty(Request $request,$id)
    {
        $order_item_id=$request->order_item_id;
        $qty=$request->qty;
        OrderItem::where('id',$order_item_id)->update(['qty'=>$qty]);
        $OrderItem=OrderItem::where('order_id',$id)->get();

        $total=0;
        foreach ($OrderItem as $key => $oi) {
            $total=$total+$oi->price*$oi->qty;
        }


        // return $total;

        Order::where('id',$id)->update(['total'=>$total]);
        ConfirmPayment::where('order_id',$id)->update(['jumlah'=>$total]);
        return back();
    }

    public function update_catatan(Request $request,$id){
        Order::where('id',$id)->update(['catatan'=>$request->note]);
        return back();
    }

    public function change_status()
    {
        $status=request('confirm_payment');
        $order_id=request('order_id');

        Order::where('id',$order_id)->update(['confirm_payment'=>$status]);

        return back();
    }

    public function change_resi()
    {
        $resi=request('resi');
        $order_id=request('order_id');

        Order::where('id',$order_id)->update(['resi'=>$resi]);

        return back();
    }

    public function invoice($id){
        $data['order']=Order::where('id',$id)->with('order_item.product_size','payment_confirm')->first();
        $pdf = Pdf::loadView('admin.invoice',$data);
        return $pdf->stream('invoice.pdf');
    }
}
