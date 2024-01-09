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
               <h3>Data Order</h3>
            </div>
            <div class="card-body">
              <div class="row">
       <!--                  <div class="col-md-4 col-12">
                          <div class="form-inline">
                           <div class="form-group">
                             <input type="text" id="search" name="search" placeholder="Cari Nama atau Email" value="" class="form-control mr-2">
                             <button type="button" id="cari" class="btn btn-primary mr-2">Cari</button>
                             <a class="btn btn-secondary mr-2" id="reset">Reset</a>
                          </div>
                       </div>
                    </div> -->
                    <div class="col-md-12 col-12">
                     <form action="" method="POST">
                        @csrf                      
                        <div class="form-inline">
                           <div class="form-group mr-2">
                              <select class="form-control" name="bulan" id="bulan">
                               <option value="">--- Silahkan Pilih Bulan ---</option>
                               <option value="01">Januari</option>
                               <option value="02">Februari</option>
                               <option value="03">Maret</option>
                               <option value="04">April</option>
                               <option value="05">Mei</option>
                               <option value="06">Juni</option>
                               <option value="07">Juli</option>
                               <option value="08">Agustus</option>
                               <option value="09">September</option>
                               <option value="10">Oktober</option>
                               <option value="11">November</option>
                               <option value="12">Desember</option>
                            </select>
                         </div>
                         <div class="form-group mr-2">
                           <select class="form-control" name="tahun" id="tahun">
                             <?php
                             $year = date("Y");
                             for ($i = $year; $i >= 2019; $i--) {
                               ?>
                               <option value="<?= $i ?>"><?= $i ?></option>
                            <?php } ?>
                         </select>
                      </div>
                      <button type="submit" class="btn btn-primary mr-2" name="filter">Filter</button>
                      <a href="" class="btn btn-secondary mr-2">Reset</a>
                   </form>
                   <div id="excel"></div>
                </div>
             </div>
             <div class="col-md-4 col-12">
                <div class="form-inline">
                </div>
             </div>
          </div>
          <table id="member-table" class="table table-bordered table-striped">
           <thead>
              <tr>
                 <th>Order ID</th>
                 <td>Tanggal</td>
                 <td>Alamat</td>
                 <td>Konfirmasi</td>
                 <td>No Resi</td>
                 <td>Total</td>
                 <td>Detail</td>
              </tr>
           </thead>
           <tbody>
            @php
            $total=0;
            @endphp
            @foreach($order as $value)
            <tr>
             <td>#{{$value->id}}</td>
             <td>{{$value->order_time}}</td>
             <td>
               {{$value->address}},{{$value->distrik}},{{$value->provinsi}}
            </td>
            <td>
               @foreach($value->payment_confirm as $payment)
               <a href="{{$payment->bukti}}" target="_blank">
                  <img src="{{$payment->bukti}}" style="width: 100px">
               </a>
               @endforeach
            </td>
            <td>
               {{$value->resi}}
            </td>
            <td>
               {{$value->total}}
            </td>
            <td>
               <div class="d-flex">
                  <a href="{{url('order/ready_stock')}}/{{$value->id}}" class="btn btn-success btn-sm">Detail Order</a>
                  @if(auth()->user()->username=='superuser')
                  <button class="btn btn-danger" data-toggle="modal" data-target="#modal-hapus{{$value->id}}">Hapus</button>
                  <div class="modal fade" id="modal-hapus{{$value->id}}">
                   <div class="modal-dialog modal-dialog-centered  modal-sm">
                     <form action="{{url('order/delete')}}" method="POST">        
                       @csrf                        
                       <div class="modal-content">
                         <div class="modal-header p-1">
                           <h5 class="modal-title">Anda akan menghapus order ini?</h5>
                           <input type="text" name="id" value="{{$value->id}}" hidden>
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                          </button>
                       </div>
                       <div class="modal-footer justify-content-end p-1">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
         @endif
      </div>
   </td>
</tr>
@php $total=$total+$value->total @endphp
@endforeach

</tbody>
<tfoot>
 <tr>
  <th>Order ID</th>
  <td>Tanggal</td>
  <td>Alamat</td>
  <td>Konfirmasi</td>
  <td>No Resi</td>
  <td>Total</td>
  <td>Detail</td>
</tr>
</tfoot>
</table>
<div class="d-flex justify-content-between mt-5">
  <p>Total</p>
  <h5 class="fw-bold">Rp{{number_format($total)}}</h5>
</div>
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
         "responsive": true, "lengthChange": false, "autoWidth": false,
         buttons: [
         {
            extend: 'excel',
            text: 'Export to Excel',
            filename:'order_report<?php echo date('d-m-Y') ?>',
            title:'Order Report',
            exportOptions: {
               columns: ':not(:last-child)'
            }
         }
         ]
      }).buttons().container().appendTo('#excel');;


   // $("#example1").DataTable({
   //    "responsive": true, "lengthChange": false, "autoWidth": false,
   //    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
   // })
   // $(document).ready(function(){
   //    var memberTable=$("#member-table").DataTable({
   //       dom: 'rt<"bottom"p>',
   //       language: {
   //        search: ""
   //     },
   //  });

})
</script>
@endsection
