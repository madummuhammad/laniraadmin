@extends('admin.main')
@section('content')
<div class="content-wrapper">
	<div class="content">
		<div class="container-fluid"><br>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<div class="card-tools">
							</div>
						</div>
						<div class="card-body table-responsive p-2">
							<div class="container">
								<div class="row">
									<div class="col-12">
										<div class="card">
											<div class="card-body">
												<!-- <a href="" class="btn btn-secondary">Kembali</a> -->
												<h4 class="text-center">TAMBAH PESANAN</h4>
												<div class="row">
													@foreach($product as $value)
													<div class="col-2">
														<div class="card">
															<div class="card-body p-0">
																<div class="products-single fix">
																	<div class="box-img-hover">
																		<a href="{{url('order/po/add/')}}/{{$id}}?product_id={{$value->id}}">
																			<img src="{{url('image/product')}}/{{$value->photo}}">
																		</a>
																	</div>
																	<div class="why-text">
																		<h4>
																			<a class="text-dark" href="{{url('order/po/add/detail/')}}/{{$id}}?product_id={{$value->id}}">{{$value->name}}</a>
																		</h4>
																	</div>
																</div>
															</div>
														</div>
													</div>
													@endforeach
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


</div>
@endsection