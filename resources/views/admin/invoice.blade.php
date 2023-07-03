<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Invoice</title>
</head>
<style>
	.table,.table tr,.table td,.table th{
		width: 100%;
		border: 1px solid black;
		border-collapse: collapse;
	}

	.table td{
		padding: 5px;
	}

	.table tbody tr td:first-child{
		width: 300px;
	}
	.fw-bold{
		font-weight: bold;
	}
</style>
<body>
	<h2>Invoice</h2>
	<table style="width:100%">
		<tr>
			<td>Order ID</td>
			<td class="fw-bold">#{{$order->id}}</td>
			<td>Tanggal</td>
			<td>{{$order->order_time}}</td>
		</tr>
		<tr>
			<td>Nama Penerima</td>
			<td class="fw-bold">{{$order->nama_penerima}}</td>
			<td>No Telp</td>
			<td>{{$order->order_tel}}</td>
		</tr>
		@if($order->order_type=='Ready Stok')
		<tr>
			<td>Alamat Pengiriman</td>
			<td class="fw-bold">{{$order->address}},{{$order->distrik}},{{$order->provinsi}}</td>
		</tr>
		@endif
	</table>
	<h5 class="fw-bold">Detail Pesanan</h5>
	<table class="table">
		<thead>		
			<tr>
				<th>Nama Produk</th>
				<th>Harga</th>
				<th>Size</th>
				<th>Jumlah</th>
				<th>Total</th>
			</tr>
		</thead>
		<tbody>	
			@php $total=0; @endphp
			@foreach($order->order_item as $key => $oi)		
			<tr>
				<td>
					{{$oi->product_name}}
				</td>
				<td>Rp{{number_format($oi->price)}}</td>
				<td>{{$oi->product_size->size}}</td>
				<td>{{$oi->qty}}</td>
				<td>Rp{{number_format($oi->price*$oi->qty)}}</td>
			</tr>
			@php $total=$total+$oi->price*$oi->qty @endphp
			@endforeach
		</tbody>
	</table>
	<table style="width: 100%; margin-top: 20px;" class="fw-bold">
		@php $total_deposit=0 @endphp
		@foreach($order->payment_confirm as $confirm)
		@php 
		$total_deposit=$total_deposit+$confirm->deposit;
		@endphp
		@endforeach
		<tr>
			<td></td>
			<td style="text-align: right;">Wajib Deposit 30%:</td>
			<td style="text-align: right;">Rp{{number_format(($total+$order->ongkir)*30/100)}}</td>
		</tr>
		<tr>
			<td></td>
			<td style="text-align: right;">Customer Deposit:</td>
			<td style="text-align: right;">Rp{{number_format($total_deposit)}}</td>
		</tr>
		<tr>
			<td></td>
			<td style="text-align: right;">Total Harga Produk:</td>
			<td style="text-align: right;">Rp{{number_format($total)}}</td>
		</tr>
		<tr>
			<td></td>
			<td style="text-align: right;">Ongkir:</td>
			<td style="text-align: right;">Rp{{number_format($order->ongkir)}}</td>
		</tr>
		<tr>
			<td></td>
			<td style="text-align: right;">Total:</td>
			<td style="text-align: right;">25.0500</td>
		</tr>
	</table>
</body>
</html>