   @extends('admin.main')
   @section('content')
   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid"><br>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <a class="btn btn-primary" href="#add-modal" data-toggle="modal" role="button">Add Slider</a>
                <div class="modal fade" id="add-modal">
                  <div class="modal-dialog modal-dialog-centered  modal-sm">
                    <form action="{{url('slider/add')}}" method="POST" enctype="multipart/form-data">        
                      @csrf                        
                      <div class="modal-content">
                        <div class="modal-header p-1">
                          <h5 class="modal-title">Add Slider</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="moda-body">
                          <input type="file" name="image" value="" class="form-control">
                        </div>
                        <div class="modal-footer justify-content-end p-1">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                          <button type="submit" class="btn btn-primary">KIRIM</button>
                        </div>
                      </div>
                    </form>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">

                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>Image</th>
                      <th>Edit</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($slider as $value)
                    <tr>
                      <td><img class="img-fluid" width="200" src="{{url('image/sliders')}}/{{$value->gambar}}" alt="" class="img-fluid"></td>
                      <td>
                        <div class="d-flex align-items-center">
                          <button class="btn btn-sm btn-primary" data-target="#modal-edit{{$value->id}}" data-toggle="modal">Edit</button>
                          <div class="modal fade" id="modal-edit{{$value->id}}">
                            <div class="modal-dialog modal-dialog-centered  modal-sm">
                              <form action="{{url('slider/edit')}}" method="POST" enctype="multipart/form-data">        
                                @csrf                        
                                <div class="modal-content">
                                  <div class="modal-header p-1">
                                    <h5 class="modal-title">Edit Slider</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="moda-body">
                                    <img src="{{url('image/sliders')}}/{{$value->gambar}}" alt="" class="img-fluid">
                                    <input type="text" name="id" value="{{$value->id}}" hidden>
                                    <input type="file" name="image" value="" class="form-control">
                                  </div>
                                  <div class="modal-footer justify-content-end p-1">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">KIRIM</button>
                                  </div>
                                </div>
                              </form>
                              <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                          </div>


                          <button class="btn btn-sm btn-danger" data-target="#modal-hapus{{$value->id}}" data-toggle="modal">Hapus</button>
                          <div class="modal fade" id="modal-hapus{{$value->id}}">
                            <div class="modal-dialog modal-dialog-centered  modal-sm">
                              <form action="{{url('slider/delete')}}" method="POST">        
                                @csrf                        
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Anda akan menghapus slider?</h5>
                                    <input type="text" name="id" value="{{$value->id}}" hidden>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-footer justify-content-end">
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
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  @include('admin.footer-page')
  @endsection