  @extends('admin.main')
  @section('content')
  <div class="content-wrapper">
  	<section class="content">
  		<div class="container-fluid pt-4">
  			<div class="row">
  				<div class="col-12">
  					<div class="card">
  						<div class="card-header">
  							<h3>Keranjang Belanja</h3>
  						</div>
  						<div class="card-body">
                       <div class="row">
                        <div class="col-md-4 col-12">
                         <div class="form-inline">
                           <div class="form-group">
                              <input type="text" id="search" name="search" placeholder="Cari Produk" value="" class="form-control mr-2">
                            <button type="button" id="cari" class="btn btn-primary mr-2">Cari</button>
                            <a class="btn btn-secondary mr-2" id="reset">Reset</a>
                         </div>
                      </div>
                   </div>
                </div>
                <table id="member-table" class="table table-bordered table-striped">
                 <thead>
                    <tr>
                       <th>Nama Pelanggan</th>
                       <td>Nama Produk</td>
                       <td>Qty</td>
                       <th>Price</th>
                       <th>Tipe Pesanan</th>
                    </tr>
                 </thead>
                 <tbody>
                   @foreach($cart as $value)
                   <tr>
                      <td>{{$value->member->nama}}</td>
                      <td>{{$value->product_size->product->name}}</td>
                      <td>{{$value->qty}}</td>
                      <td>{{$value->price}}</td>
                      <td>{{$value->type_product}}</td>
                   </td>
                </tr>
                @endforeach

             </tbody>
             <tfoot>
                <tr>
                 <th>Nama Pelanggan</th>
                 <td>Nama Produk</td>
                 <td>Qty</td>
                 <th>Price</th>
                 <th>Tipe Pesanan</th>
              </tr>
           </tfoot>
        </table>
     </div>
  </div>
</div>
</div>
</div>
</section>
</div>
@include('admin.footer-page')
<script>
   $(document).ready(function(){
      var memberTable=$("#member-table").DataTable({
         dom: 'rt<"bottom"p>',
         language: {
          search: ""
       }
    });

      $('#search').on('keyup', function() {
         var searchText = $("#search").val();
         memberTable.column([1]).search(searchText).draw();
      });

      $('#cari').on('click', function() {
         var searchText = $("#search").val();
         memberTable.column([1]).search(searchText).draw();
      });

      $('#reset').on('click', function() {
         var searchText = $("#search").val("");
         memberTable.column([1]).search("").draw();
      });

   })
</script>
@endsection
