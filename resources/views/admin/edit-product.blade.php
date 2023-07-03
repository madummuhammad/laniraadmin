  @extends('admin.main')
  @section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  	<!-- Main content -->
  	<section class="content">
  		<div class="container-fluid">
  			<div class="row">
  				<div class="col-12">
  					<div class="card">
  						<div class="card-header">
  							<h4>Edit Produk</h4>
  						</div>
  						<div class="card-body">
  							<form action="{{url('product/edit')}}/{{$product->id}}" method="post" enctype="multipart/form-data">
  								@csrf
  								<div id="item-form">
  									<br>
  									<div class="form-group">
  										<label for="inputName">Nama Produk</label>
  										<input type="text" id="inputName" class="form-control" name="name_produk" value="{{$product->name}}" required>
  									</div>
  									<div class="form-group">
  										<label for="inputName">Link Katalog</label>
  										<input type="text" id="inputName" class="form-control" name="link_katalog" value="{{$product->link_katalog}}">
  									</div>
  									<div class="form-group">
  										<label for="inputName">Diskon Produk</label><span style="color: red"> Dalam %</span>
  										<input type="text" id="inputName" class="form-control" name="diskon_produk" required value="{{$product->diskon_produk}}">
  									</div>
  									<div class="form-group">
  										<label for="inputStatus">Brand</label>
  										<select id="inputStatus" class="form-control custom-select" name="brand" required>
  											<!-- <option selected disabled>---Silahkan pilih brand---</option> -->
  											@foreach($brand as $value)
  											<option value="{{$value->id}}" @if($product->brand_id==$value->id) selected @endif>{{$value->name}}</option>
  											@endforeach
  										</select>
  									</div>

  									<div class="form-group">
  										<label for="inputStatus">Tipe Produk</label>
  										<select id="type_select" class="form-control custom-select" name="type_product"required>
  											<option selected disabled>---Silahkan pilih tipe produk---</option>
  											<option value="Ready Stok" @if($product->type_product=='Ready Stok') selected @endif>Ready Stok</option>
  											<option value="PO" @if($product->type_product=='PO') selected @endif>PO</option>
  										</select>
  										<span id="row_dim" style="color: red"><b>*Silahkan input stok lebih banyak</b></div>
  										</div>

  										<div class="form-group">
  											<label for="inputDescription">Deskripsi Produk</label>
  											<textarea id="inputDescription" class="form-control" rows="4" name="deskripsi_produk"> {{$product->deskripsi}}</textarea>
  										</div>

  										<div class="form-group">
  											<label for="inputName">Berat</label><span style="color: red"> contoh: 0.xx</span>
  											<input type="text" id="inputName" class="form-control" value="{{$product->berat}}" name="berat" required>
  										</div>

  										<div class="form-group">
  											<label for="inputDescription">Gambar Produk</label>
  											<br>
  											@if(!empty($product->photo))
  											<img src="{{url('image/product')}}/{{$product->photo}}" width="200" height="200">
  											@endif
  											<input type="file" class="form-control mt-3" name="img">
  										</div>

  										<table class="table table-bordered">
  											<thead>
  												<tr>
  													<th>Size</th>
  													<th>Stok</th>
  													<th>Price</th>
  												</tr>
  											</thead>
  											<tbody>
  												@foreach($product->product_size as $size)
  												<tr>
  													<td>
  														<input type="text" name="size_id[]" value="{{$size->id}}" hidden>
  														<input type="text" class="form-control" readonly name="size[]" value="{{$size->size}}" required></td>
  														<td>
  															<input type="number" class="form-control" name="stok[]" value="{{$size->stok}}" required>
  														</td>
  														<td>
  															<input type="number" class="form-control" name="price[]" value="{{$size->price}}" required>
  														</td>
  													</tr>
  													@endforeach
  												</tbody>
  											</table>

  											<div class="form-group">
  												<label for="inputStatus">Status</label>
  												<select id="inputStatus" class="form-control custom-select" name="status" required>
  													<option selected disabled>---Pilih Status---</option>
  													<option value="Publish" @if($product->status=='Publish') selected @endif>Publish</option>
  													<option value="Unpublish" @if($product->status=='Unpublish') selected @endif>Unpublish</option>
  												</select>
  											</div>
  											<div class="d-flex justify-content-between">
  												<button type="button" class="btn btn-primary" id="add-row">Tambah Ukuran</button>
  												<button type="submit" class="btn btn-success">Insert Produk</button>
  											</div>
  										</div>
  									</form>
  								</div>
  								<!-- /.card-body -->
  							</div>
  							<!-- /.card -->
  						</div>
  						<!-- /.col -->
  					</div>
  					<!-- /.row -->
  				</div>
  				<!-- /.container-fluid -->
  			</section>
  			<!-- /.content -->
  		</div>
          @include('admin.footer-page')
          @endsection