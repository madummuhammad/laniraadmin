  @extends('admin.main')
  @section('content')
  <style>
    #excel button{
      background: #4FA746;
    }
  </style>
  <div class="content-wrapper">
   <section class="content">
     <div class="container-fluid pt-4">
       <div class="row">
         <div class="col-12">
           <div class="card">
             <div class="card-header">
               <h3>Produk Terjual {{$type}}</h3>
             </div>
             <div class="card-body">
              <div class="row">
               <div class="col-md-4 col-12">
                <div class="form-inline">
                  <div class="form-group">
                   <input type="text" id="search" name="search" placeholder="Cari Nama atau Email" value="" class="form-control mr-2">
                   <button type="button" id="cari" class="btn btn-primary mr-2">Cari</button>
                   <a class="btn btn-secondary mr-2" id="reset">Reset</a>
                   <div id="excel"></div>
                 </div>
               </div>
             </div>
           </div>
           <table id="member-table" class="table table-bordered table-striped">
            <thead>
             <tr>
               <th>Produk Name</th>
               <td>Size</td>
               <td>Terjual</td>
             </tr>
           </thead>
           <tbody>
            @foreach($data as $value)
            <tr>
              <td>{{$value['product_name']}}</td>
              <td>{{$value['size']}}</td>
              <td>{{$value['qty']}}</td>
            </tr>
            @endforeach

          </tbody>
          <tfoot>
           <tr>
            <th>Produk Name</th>
            <td>Size</td>
            <td>Terjual</td>
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
   },
   buttons: [
   {
     extend: 'excel',
     text: 'Export to Excel',
     title:'Produk Terjual <?php echo $type ?>',
     filename:'Produk-terjual'
   }
   ]
 })

  memberTable.buttons().container().appendTo('#excel');

  $('#cari').on('click', function() {
   var searchText = $("#search").val();
   memberTable.column([0]).search(searchText).draw();
 });

  $('#reset').on('click', function() {
   var searchText = $("#search").val("");
   memberTable.column([0]).search("").draw();
 });

})
</script>
@endsection
