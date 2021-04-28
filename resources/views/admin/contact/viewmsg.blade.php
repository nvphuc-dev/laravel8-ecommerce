@extends('admin.admin_master')
@section('admin')
<div class="col-lg-12">
	<div class="card card-default">
		<div class="card-header card-header-border-bottom">
			<h2>View Contact Message</h2>
		</div>
		<div class="card-body">
			<form action="" method="" enctype="multipart/form-data">
				<div class="form-group">
					<label for="">Name</label>
					<input type="text" class="form-control" value="{{ $viewmsg->name }}" readonly>
				</div>
				<div class="form-group">
					<label for="">Email</label>
					<input type="email" class="form-control" value="{{ $viewmsg->email }}" readonly>
				</div>
				<div class="form-group">
					<label for="">Subject</label>
					<input type="text" class="form-control" value="{{ $viewmsg->subject }}" readonly>
				</div>
				<div class="form-group">
					<label for="">Message</label>
					<textarea class="form-control" rows="5" readonly>{{ $viewmsg->message }}</textarea>
				</div>
				<div class="form-footer pt-4 pt-5 mt-4 border-top">
					<a href="{{ url('/admin/message') }}" class="btn btn-primary btn-default">Back</a>
					<a href="{{ url('message/delete/'.$viewmsg->id) }}" onclick="return confirm('Are you sure to delete?')" class="btn btn-secondary btn-danger">Delete</a>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection