  @extends('admin.main')
  @section('content')
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid pt-5">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
               <form action="{{url('footer')}}" method="POST">
                @csrf
                <div class="form-group">
                  <label for="inputName">About</label>
                  <input type="text" id="inputName" class="form-control" name="about" value="{{$footer->about}}">
                </div>
                <div class="form-group">
                  <label for="inputName">Contact</label>
                  <input type="text" id="inputName" class="form-control" name="contact" value="{{$footer->contact}}">
                </div>
                <div class="form-group">
                  <label for="inputName">Email</label>
                  <input type="text" id="inputName" class="form-control" name="email" value="{{$footer->email}}">
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-success">Update</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@include('admin.footer-page')
@endsection