@extends('admin.main')
@section('content')
<div class="wrapper">
	<div class="content-wrapper">
		<div class="content">
			<div class="container-fluid"><br>
				<div class="row">
					<div class="col-12">
						<div class="card">
							<div class="card-body">
								<h4 class="text-center">Pengaturan Expedisi</h4>
								<form action="{{url('expedisi')}}" method="POST">
									@csrf
									<div class="row">											
										<?php foreach ($expedisi as $key => $value):?>
											<div class="col-3">													
												<div class="custom-control custom-switch">
													<input type="text" name="id_<?php echo $value['rate_name'] ?>" value="<?php echo $value['id'] ?>" hidden>
													<input type="checkbox" class="custom-control-input" name="<?php echo $value['rate_name'] ?>" id="<?php echo $value['rate_name'] ?>" <?php if($value['status']==1){echo 'checked';} ?>>
													<label class="custom-control-label" for="<?php echo $value['rate_name'] ?>"><?php echo $value['name'] ?></label>
												</div>
											</div>
										<?php endforeach ?>
									</div>
									<div class="d-flex justify-content-end mt-3">
										<button class="btn btn-primary px-4 mr-5">Kirim</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@include('admin.footer-page')
@endsection