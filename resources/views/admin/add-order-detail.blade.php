@extends('admin.main')
@section('content')
<div class="content-wrapper">
	<div class="content">
		<div class="container-fluid"><br>
			<div class="container-fluid"><br>
				<div class="row">
					<div class="col-12">
						<div class="card">
							<div class="card-body">
								<div class="mb-3">
									<h4 class="text-left fw-bold">{{$product->name}}</h>
									</div>
									<div class="row">
										<div class="col-4">
											<img class="d-block w-100" src="{{url('image/product')}}/{{$product->photo}}" alt="First slide">
										</div>
										<div class="col-6">
											<form action="{{url('order/po/add/')}}/{{$id}}" method="POST">
												@csrf
												<div class="form-group">
													<label for="size">Size</label>
													<select name="size" class="form-control" id="size">
														@foreach($product->product_size as $size)
														<option value="{{$size->id}}" data-stok="{{$size->stok}}" data-price="{{$size->price}}">{{$size->size}}</option>
														@endforeach
													</select>
												</div>
												<input type="text" name="product_id" value="{{$product->id}}" hidden>
												<div class="form-group">
													<label for="price">Price</label>
													<input type="number" id="price" readonly class="form-control" name="price" required>
												</div>
												<div class="form-group">
													<label for="quantity">Quantity</label>
													<input type="number" value="1" id="quantity" class="form-control" name="quantity" required>
												</div>
												<button class="btn btn-primary">Tambah</button>
											</form>
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
@include('admin.footer-page')
<script>
	$(document).ready(function(){
		getPrice();
		$("#quantity").on('keyup',function(){
			getPrice();
		})

		$("#size").on('change',function(){
			getPrice();
		})

		function getPrice()
		{
			var price=$("#size").find(':selected').data('price');
			var qty=$("#quantity").val();
			$("#price").val(price*qty)
		}
	})
</script>
@endsection