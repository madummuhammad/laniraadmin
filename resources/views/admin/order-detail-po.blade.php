@extends('admin.main')
@section('content')
<div class="content-wrapper">
	<div class="content">
		<div class="container-fluid"><br>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body table-responsive p-2">
							<div class="container">
								<div class="row">
									<div class="col-md-4">
										<strong>Pembelian</strong>
										<div>
											No Pembelian : #{{$order->id}}
										</div>
										<div>
											Tanggal : {{$order->order_time}}
										</div>
									</div>

									<div class="col-md-4">
										<strong>Pelanggan</strong>
										<div>
											Nama Penerima : {{$order->nama_penerima}}
										</div>
										<div>
											No Telp : {{$order->order_tel}}
										</div>
										<div>
											Email : {{$order->order_email}}
										</div>
									</div>
									@if($order->sender_dropship)
									<div class="col-md-4">
										<strong>Dropship </strong><br>
										<p class="p-0 m-0">Pengirim: {{$order->sender_dropship}}</p>
										<p class="p-0 m-0">No Hp: {{$order->phone_dropship}}</p>
									</div>
									@endif
								</div>
								<br>
								<div class="form-inline">									
									<div class="form-group mr-3">
										<form method="POST" action="{{url('order/change_status')}}">
											@csrf
											<div class="input-group">
												<select name="confirm_payment" class="form-control">
													<option value="On Checking" @if($order->confirm_payment=='On Checking') selected @endif>On Checking</option>
													<option value="Pesanan diproses" @if($order->confirm_payment=='Pesanan diproses') selected @endif>Pesanan diproses</option>
													<option value="Pesanan dikirim" @if($order->confirm_payment=='Pesanan dikirim') selected @endif>Pesanan dikirim</option>
												</select>
												<input type="hidden" name="order_id" value="{{$order->id}}">
												<div class="input-group-append">
													<button type="submit" class="btn btn-primary">Simpan</button>
												</div>
											</div>
										</form>
									</div>

									<div class="form-group">
										<form method="POST" action="{{url('order/change_resi')}}">
											@csrf
											<div class="input-group">
												<input type="hidden" name="order_id" value="{{$order->id}}">
												<input type='text' name='resi' value='{{$order->resi}}' class='form-control' placeholder='Input Resi'>
												<div class="input-group-append">
													<button type="submit" class="btn btn-primary">Simpan</button>
												</div>
											</div>
										</form>
									</div>
								</div>
								<div class="d-flex align-items-center mt-4">
									<a href="{{url('order/invoice/')}}/{{$order->id}}" class="btn btn-danger mr-2" target="_blank">Print Invoice</a><br>
									<a href="{{url('order/po/add/')}}/{{$order->id}}" class="btn btn-secondary">TAMBAH PESANAN</a>
								</div>
								<table class="table table-hover text-nowrap">
									<thead>
										<tr>
											<th>No</th>
											<th>Produk</th>
											<th>Size</th>
											<th>QTY</th>
											<th>Harga</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										@php $total=0; @endphp
										@foreach($order->order_item as $key => $oi)
										<tr>
											<td>{{$key+1}}</td>
											<td>{{$oi->product_name}}</td>
											<td>{{$oi->product_size->size}}</td>
											<!-- <td>{{$oi->qty}}</td> -->
											<td>
												<form method="POST" action="{{url('order/po/update_qty')}}/{{$order->id}}">
													@csrf
													<div class="d-flex justify-content-center" style="width:130px">
														<input type="hidden" name="order_item_id" value="{{$oi->id}}">
														<input type="number" class="form-control" name="qty" value="{{$oi->qty}}">
														<button type="submit" class="btn btn-sm btn-primary">Update</button>
													</div>
												</form>
											</td>
											<td>{{number_format($oi->price*$oi->qty)}}</td>
											<td>
												<form action="{{url('order/po/delete')}}" method="POST">
													@csrf
													<input type="text" hidden name="order_item_id" value="{{$oi->id}}">

													<input type="text" hidden name="order_id" value="{{$order->id}}">
													<input type="text" hidden name="price" value="<?php echo $oi->price*$oi->qty ?>">
													<input type="text" hidden name="total" value="<?php echo $order->total ?>">
													<button class="btn btn-sm btn-danger" name="hapus">Hapus</button>
												</form>
											</td>
										</tr>
										@php $total=$total+$oi->price*$oi->qty @endphp
										@endforeach
										<tr>
											<td colspan="4"><b>Total</b></td>
											<td>Rp. {{number_format($total+$order->ongkir)}}</td>
										</tr>
										<tr>
											<td colspan="4"><b>Riwayat Transaksi</b></td>
											<td>
												<button class="btn btn-outline-secondary btn-sm" onclick="toggleDetail()">Detail Transaksi</button>
												<div id="detailTransaksi" style="display: none;">
													<table>
														<thead>
															<tr>
																<th>BANK</th>
																<th>Deposit</th>
																<th>Bukti</th>
															</tr>
														</thead>
														<tbody>
															@php $total_payment=0 @endphp
															@foreach($order->payment_confirm as $payment)
															<tr>
																<td>{{$payment->bank}}</td>
																<td>Rp{{number_format($payment->deposit)}}</td>
																<td>
																	<a target="_blank" href="https://laniragroup.com/image/bukti/{{$payment->bukti}}">attachment</a>
																	
																</td>
																<td></td>
															</tr>
															@php $total_payment=$total_payment+$payment->deposit; @endphp
															@endforeach
															<tr>
																<td colspan="2"><b>Total Deposit</b></td>
																<td><b>Rp{{number_format($total_payment)}}</b></td>
															</tr>
															<tr>
																<td colspan="2"><b>Wajib Deposit 30%</b></td>
																<td><b>Rp. {{number_format(($total+$order->ongkir)*30/100)}}</b></td>
															</tr>
															<tr>
																<td colspan="2"><b style="color: red">Sisa Pelunasan</b></td>
																<td><b>Rp. {{number_format($total+$order->ongkir-$total_payment)}}</b></td>
															</tr>
															<tr>
																<td colspan="2"><b>Total Penjualan</b></td>
																<td><b>Rp. {{number_format($total+$order->ongkir)}}</b></td>
															</tr>
														</tbody>
													</table>
												</div>
											</td>
										</tr>
										<br>
										<div id="staticNote">
											<div>Catatan : <b style="color: red">{{$order->catatan}}</b></div>
											<button class="btn btn-success mt-2 mb-4 staticNoteButton" id="ubah" onclick="toggleNote()">Ubah Catatan</button>
										</div>
										<div id="dinamicNote" style="display: none;">
											<form action="{{url('order/po/update_catatan/')}}/{{$order->id}}" method="POST">
												@csrf
												<div class="form-group">
													<label for="" class="fw-normal" style="font-weight: normal;">
														Catatan :
													</label>
													<div class="input-group">
														<input type="text" name="note" value="{{$order->catatan}}" class="form-control">
														<div class="input-group-append">
															<button class="btn btn-sm btn-success staticNoteButton" id="ubah">Ubah Catatan</button>
														</div>
													</div>
												</div>
											</form>
										</div>
										<!-- <span>Catatan : <b style="color: red">{{$order->catatan}}</b></span> -->

										<script>
											function toggleDetail() {
												var detailTransaksi = document.getElementById("detailTransaksi");
												if (detailTransaksi.style.display === "none") {
													detailTransaksi.style.display = "block";
												} else {
													detailTransaksi.style.display = "none";
												}
											}
										</script>
										<script>
											function toggleNote() {
												var dinamicNote = document.getElementById("dinamicNote");
												var staticNote=document.getElementById("staticNote");
												if (dinamicNote.style.display === "none") {
													dinamicNote.style.display = "block";
												} else {
													dinamicNote.style.display = "none";
												}
												if (staticNote.style.display === "none") {
													staticNote.style.display = "block";
												} else {
													staticNote.style.display = "none";
												}
											}
										</script>
									</tbody>
								</table>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<aside class="control-sidebar control-sidebar-dark">
		<div class="p-3">
			<h5>Title</h5>
			<p>Sidebar content</p>
		</div>
	</aside>

</div>
@endsection