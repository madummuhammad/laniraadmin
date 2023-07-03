@extends('admin.main')
@section('content')
<div class="content-wrapper">
	<!-- Main content -->
	<div class="content">
		<div class="container-fluid"><br>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h3>Add Member</h3>
							<form action="{{url('member/edit/')}}/{{$member->id}}" method="post">
								@csrf
								<div id="item-form">
									<br>
									<div class="form-group">
										<label for="inputName">Nama</label>
										<input type="text" id="inputName" class="form-control" required name="nama" value="{{$member->nama}}">
									</div>
									<div class="form-group">
										<label for="inputName">Email</label>
										<input type="text" id="inputName" class="form-control" required name="email" value="{{$member->email}}">
									</div>
									<div class="form-group">
										<label for="inputName">Password</label>
										<input type="text" id="inputName" class="form-control" name="password">
									</div>
									<div class="form-group">
										<label for="inputName">No WA</label>
										<input type="text" id="inputName" class="form-control" required name="no_wa" value="{{$member->no_wa}}">
									</div>
									<div class="d-flex justify-content-between">
										<button type="submit" class="btn btn-success">Update Member</button>
									</div>
								</div>
							</form>
						</div>
						<!-- /.card-header -->
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