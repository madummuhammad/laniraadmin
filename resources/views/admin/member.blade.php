  @extends('admin.main')
  @section('content')
  <div class="content-wrapper">
  	<section class="content">
  		<div class="container-fluid pt-4">
  			<div class="row">
  				<div class="col-12">
  					<div class="card">
  						<div class="card-header">
  							<a href="{{url('member/add')}}" class="btn btn-primary">Add Member</a>
  						</div>
  						<div class="card-body">
                      <div class="row">
                        <div class="col-md-4 col-12">
                          <div class="form-inline">
                           <div class="form-group">
                             <input type="text" id="search" name="search" placeholder="Cari Nama atau Email" value="" class="form-control mr-2">
                             <button type="button" id="cari" class="btn btn-primary mr-2">Cari</button>
                             <a class="btn btn-secondary mr-2" id="reset">Reset</a>
                          </div>
                       </div>
                    </div>
                 </div>
                 <table id="member-table" class="table table-bordered table-striped">
                   <thead>
                      <tr>
                         <th>Nama</th>
                         <td>Email</td>
                         <td>Whatsapp</td>
                         <th>Aksi</th>
                      </tr>
                   </thead>
                   <tbody>
                    @foreach($member as $value)
                    <tr>
                       <td>{{$value->nama}}</td>
                       <td>{{$value->email}}</td>
                       <td>{{$value->no_wa}}</td>
                    </td>
                    <td>
                       <div class="btn-group">
                          <a href="{{url('member/history')}}/{{$value->id}}" class="btn btn-primary">History</a>
                          <a href="{{url('member/edit')}}/{{$value->id}}" class="btn btn-secondary">Edit</a>
                          <button class="btn btn-danger" data-toggle="modal" data-target="#modal-hapus{{$value->id}}">Hapus</button>
                          <div class="modal fade" id="modal-hapus{{$value->id}}">
                             <div class="modal-dialog modal-dialog-centered  modal-sm">
                                <form action="{{url('member/delete')}}" method="POST">        
                                   @csrf                        
                                   <div class="modal-content">
                                      <div class="modal-header p-1">
                                         <h5 class="modal-title">Anda akan menghapus {{$value->nama}}</h5>
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
                     </div>
                  </td>
               </tr>
               @endforeach

            </tbody>
            <tfoot>
              <tr>
                 <th>Nama</th>
                 <td>Email</td>
                 <td>Whatsapp</td>
                 <th>Aksi</th>
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
         memberTable.column([0,1]).search(searchText).draw();
      });

      $('#cari').on('click', function() {
         var searchText = $("#search").val();
         memberTable.column([0,1]).search(searchText).draw();
      });

      $('#reset').on('click', function() {
         var searchText = $("#search").val("");
         memberTable.column([0,1]).search("").draw();
      });

   })
</script>
@endsection
