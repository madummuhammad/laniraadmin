  @extends('admin.main')
  @section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid pt-4">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <a href="{{url('product/add')}}" class="btn btn-primary">Add Produk</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Item</th>
                      <td>Tipe Produk</td>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($product as $value)
                    <tr>
                      <td>{{$value->name}}</td>
                      <td>{{$value->type_product}}
                      </td>
                      <td>
                        <div class="btn-group">
                          <a href="{{url('product/edit')}}/{{$value->id}}" class="btn btn-secondary">Edit</a>
                          <button class="btn btn-danger" data-toggle="modal" data-target="#modal-hapus{{$value->id}}">Hapus</button>
                          <div class="modal fade" id="modal-hapus{{$value->id}}">
                            <div class="modal-dialog modal-dialog-centered  modal-sm">
                              <form action="{{url('product/delete')}}" method="POST">        
                                @csrf                        
                                <div class="modal-content">
                                  <div class="modal-header p-1">
                                    <h5 class="modal-title">Anda akan menghapus produk</h5>
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
                              <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                          </div>
                        </div>
                      </td>
                    </tr>
                    @endforeach

                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Item</th>
                      <td>Tipe Produk</td>
                      <th>Aksi</th>
                    </tr>
                  </tfoot>
                </table>
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
